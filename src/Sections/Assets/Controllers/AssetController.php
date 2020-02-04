<?php

namespace NetLinker\FastBaselinker\Sections\Assets\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AssetController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get resource CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function cssSystemNotify(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/system-notify/css/main.css';
        $content = File::get($path);

        return Response::make($content, 200)
            ->header('Content-Type', 'text/css');
    }

    /**
     * Get resource CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function cssIndigoLayout(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/css/main.css';
        $pathEditor = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/css/editor.css';

        $content = File::get($path);
        $contentEditor = File::get($pathEditor);

        return Response::make($content . $contentEditor, 200)
            ->header('Content-Type', 'text/css');
    }

    /**
     * Get resource CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function cssTableBuilder(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/table-builder/css/main.css';

        $content = File::get($path);

        return Response::make($content, 200)
            ->header('Content-Type', 'text/css');
    }

    /**
     * Get resource CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function cssContextMenu(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/context-menu/css/main.css';

        $content = File::get($path);

        return Response::make($content, 200)
            ->header('Content-Type', 'text/css');
    }

    /**
     * Get resource CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function cssModalWindow(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/modal-window/css/main.css';

        $content = File::get($path);

        return Response::make($content, 200)
            ->header('Content-Type', 'text/css');
    }

    /**
     * Get resource CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function cssFormBuilder(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/form-builder/css/main.css';

        $content = File::get($path);

        return Response::make($content, 200)
            ->header('Content-Type', 'text/css');
    }


    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsIndigoLayout(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsSystemNotify(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/system-notify/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsThemeSwitcher(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/theme-switcher/js/main.js';
        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsContextMenu(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/context-menu/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsBaseJs(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/base-js/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsTableBuilder(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/table-builder/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsModalWindow(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/modal-window/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource JS
     *
     * @return \Illuminate\Http\Response
     */
    public function jsFormBuilder(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/form-builder/js/main.js';

        $content = File::get($path);

        return Response::make($content , 200)
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Get resource fonts
     *
     * @return \Illuminate\Http\Response
     */
    public function fontsIconsWoff(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/fonts/icons.woff';

        $content = File::get($path);
        $mimeType = File::mimeType($path);

        return Response::make($content , 200)
            ->header('Content-Type', $mimeType);
    }

    /**
     * Get resource fonts
     *
     * @return \Illuminate\Http\Response
     */
    public function fontsIconsTtf(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/fonts/icons.ttf';

        $content = File::get($path);
        $mimeType = File::mimeType($path);

        return Response::make($content , 200)
            ->header('Content-Type', $mimeType);
    }

    /**
     * Get resource fonts
     *
     * @return \Illuminate\Http\Response
     */
    public function fontsIconsEot(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/fonts/icons.eot';

        $content = File::get($path);
        $mimeType = File::mimeType($path);

        return Response::make($content , 200)
            ->header('Content-Type', $mimeType);
    }

    /**
     * Get resource img
     *
     * @return \Illuminate\Http\Response
     */
    public function imgLoadingSvg(Request $request)
    {
        $path = __DIR__ . '/../../../../resources/assets/vendor/indigo-layout/img/loading.svg';

        $content = File::get($path);
        $mimeType = File::mimeType($path);

        return Response::make($content , 200)
            ->header('Content-Type', $mimeType);
    }

}
