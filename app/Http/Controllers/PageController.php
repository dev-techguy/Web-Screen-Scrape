<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrawlRequest;
use Exception;
use Goutte\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller {
    /**
     * Instance of controller
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * check time
     * @return string
     */
    public static function stateTimer() {
        if (date('H') < 12) {
            return "Good Morning";
        } elseif (date('H') > 11 && date('H') < 18) {
            return "Good Afternoon";
        } elseif (date('H') > 17) {
            return "Good Evening";
        }
    }

    /**
     * welcome page here
     * @return Factory|View
     */
    public function welcome() {
        return view('welcome', [
            'crawler' => null,
        ]);
    }

    /**
     * start crawling here
     * @param CrawlRequest $request
     * @return Factory|RedirectResponse|View
     */
    public function crawl(CrawlRequest $request) {
        try {
            if (!filter_var($request->url, FILTER_VALIDATE_URL))
                return redirect()->back()->with('error', 'Please enter a valid website url.');


            $client = new Client();
            // Go to the symfony.com website
            $crawler = $client->request('GET', $request->url);

            return view('welcome', [
                'crawler' => $crawler,
                'url' => $request->url,
            ]);

        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Sorry!! An error occurred. Please check your url and try again');
        }
    }
}
