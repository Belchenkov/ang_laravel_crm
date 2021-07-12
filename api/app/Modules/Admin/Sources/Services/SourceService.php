<?php


namespace App\Modules\Admin\Sources\Services;


use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Sources\Requests\SourceRequest;

class SourceService
{
    public function getSources()
    {
        return Source::all();
    }

    public function save(SourceRequest $request, Source $source): Source
    {
        $source->fill($request->only($source->getFillable()));
        $source->save();

        return $source;
    }
}
