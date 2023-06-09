<?php

namespace App\Http\Controllers;

use App\Article;
use App\Device;
use App\Chapter;
use App\News;
use App\Question;
use App\SubChapter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SearchController extends StaticController
{
    public function result($slug=null)
    {
        if (!$slug) return redirect()->back();
        $this->data['found'] = collect();
        $this->data['searching'] = $slug;

        $this->getFound(new Device(), 'devices');
        $this->getFound(new Chapter());
        $this->getFound(new SubChapter());
        $this->getFound(new Article(), 'articles');
        $this->getFound(new News(), 'news');
        $this->getFound(new Question(), 'faq');

        $this->data['found'] = $this->data['found']->paginate(10);
        return $this->showView('search');
    }

    private function getFound(Model $model, $prefix=null)
    {
        $fields = $model->getFillable();
        $searchInFields = '';
        $validFields = [
            'head',
            'head_ru',
            'content',
            'content_ru',
            'question_ru',
            'answer_ru'
        ];

        foreach ($fields as $field) {
            if (in_array($field, $validFields)) $searchInFields .= $field.',';
        }
        $searchInFields = substr($searchInFields, 0, -1);

        $found = $model->whereRaw(
            'MATCH('.$searchInFields.') AGAINST(? IN BOOLEAN MODE)',
            array($this->data['searching'])
        )->get();

        foreach ($found as $item) {
            if (isset($item->head) && $item->head) $head = $item->head;
            elseif (isset($item->head_ru) && $item->head_ru) $head = $item->head_ru;
            else $head = $item->question_ru;

            if (isset($item->content) && $item->content) $text = $item->content;
            elseif (isset($item->content_ru) && $item->content_ru) $text = $item->content_ru;
            else $text = $item->answer_ru;

            if ($prefix) {
                $href = '/'.$prefix;
                if (isset($item->slug)) $href .= '/'.$item->slug;
                else $href .= '?id=' . $item->id;
            } elseif ($model instanceof SubChapter) {
                $href = '/'.$item->chapter->slug.'/'.$item->slug;
            } else $href = '/'.$item->slug;

            $this->data['found']->push([
                'href' => url($href),
                'head' => $head,
                'text' => $text,
            ]);
        }
    }
}
