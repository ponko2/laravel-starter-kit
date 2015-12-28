<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    /**
     * @var ContactRepository
     */
    protected $contacts;

    /**
     * コンストラクタ
     *
     * @param ContactRepository $contacts
     */
    public function __construct(ContactRepository $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        // 確認画面で戻るボタンが押された場合
        if ($request->get('action') === 'back') {
            // 入力画面へ戻る
            return redirect()
                ->route('contacts.index')
                ->withInput($request->except(['action', 'confirming']));
        }

        // データベースに登録
        $this->contacts->create($request->all());

        // ブラウザリロード等での二重送信防止
        $request->session()->regenerateToken();

        // 完了画面を表示
        return view('contacts.thanks');
    }
}
