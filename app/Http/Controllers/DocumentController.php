<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Documentation;

class DocumentController extends Controller
{

    public function show($version, $page='')
    {
        if(! $this->validVersion($version)){
            return redirect('docs/'.DEFAULT_VERSION.'/'.$version);
        }
        
        try{
            return view('docs', [
                'content' => Documentation::get($version, $page, resource_path('docs'))
            ]);
        }
        
        catch (\Exception $e)
        {
            abort(404, 'The requested doc not found');
        }
        //Documentation::get($version, $page);

    }

    protected function validVersion($version)
    {
        return in_array($version, Documentation::versions());
    }
}
