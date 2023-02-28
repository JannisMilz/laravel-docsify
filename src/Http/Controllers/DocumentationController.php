<?php

namespace JannisMilz\Docsify\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Gate;
use JannisMilz\Docsify\Models\Documentation;

class DocumentationController extends Controller
{
    /**
     * @var Documentation
     */
    protected $documentation;

    /**
     * DocumentationController constructor.
     * @param Documentation $documentationRepository
     */
    public function __construct(Documentation $documentation)
    {
        $this->documentation = $documentation;

        // if (config('docsify.settings.auth')) {
        //     $this->middleware(['auth']);
        // } else {
        //     if (config('docsify.settings.middleware')) {
        //         $this->middleware(config('docsify.settings.middleware'));
        //     }
        // }
    }

    /**
     * Redirect the index page of docs to the default version.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route(
            'docsify.show',
            [
                'version' => config('docsify.versions.default'),
                'page' => "index"
            ]
        );
    }

    /**
     * Show a documentation page.
     *
     * @param $version
     * @param null $page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($version, $page = "index")
    {
        $documentation = $this->documentation->getVersionPage($version, $page);
        // dd($documentation->statusCode);
        if ($documentation->statusCode != 200) {
            return abort($documentation->statusCode);
        }

        // if (Gate::has('viewLarecipe')) {
        //     $this->authorize('viewLarecipe', $documentation);
        // }

        return response()->view('docsify::docs', [
            'title'          => $documentation->title,
            'sidebar'        => $documentation->sidebar,
            'content'        => $documentation->content,
            'currentVersion' => $version,
            'versions'       => $documentation->publishedVersions,
            // 'currentSection' => $documentation->currentSection,
        ], $documentation->statusCode);
    }
}
