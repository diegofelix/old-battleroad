<?php

namespace Battleroad\Http\Controllers;

class BaseController extends Controller
{
    /**
     * @var string
     */
    protected $layout;

    /**
     * Setup the layout used by the controller.
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = view($this->layout);
        }
    }

    /**
     * Return an view.
     *
     * @param string $view
     * @param array  $params
     *
     * @return \Illuminate\Http\Response
     */
    public function view($view, array $params = [])
    {
        return view($view, $params);
    }

    /**
     * Redirect the user to an url.
     *
     * @param string $url
     * @param array  $with
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($url, $with = [])
    {
        return redirect()->to($url)->with($with);
    }

    /**
     * Redirect the user to an route.
     *
     * @param string $route
     * @param array  $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectRoute($route, $params = [])
    {
        return redirect()->route($route, $params);
    }

    /**
     * Redirect the user back with an message.
     *
     * @param array $with
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectBack(array $with = null)
    {
        return redirect()->back()->withInput()->with($with);
    }

    /**
     * Redirect the user to the intended page before login or to a default
     * page in case has no one url.
     *
     * @param string $fallback
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectIntended($fallback = 'admin/joins')
    {
        if (auth()->user()->isOrganizer()) {
            $fallback = 'admin/dashboard';
        }

        return redirect()->intended($fallback);
    }
}
