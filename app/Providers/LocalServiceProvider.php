<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LocalServiceProvider extends ServiceProvider
{
    /**
     * localでのみ設定したいサービスプロバイダー
     *
     * @var array
     */
    protected $providers = [
        \Barryvdh\Debugbar\ServiceProvider::class,
    ];

    /**
     * localでのみ設定したいクラスエイリアス
     *
     * @var array
     */
    protected $aliases = [
        'Debugbar' => \Barryvdh\Debugbar\Facade::class,
    ];

    /**
     * アプリケーションサービスの初期化処理
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * アプリケーションサービスの登録
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->registerProviders();
            $this->registerAliases();
        }
    }

    /**
     * サービスプロバイダーの登録
     *
     * @return void
     */
    protected function registerProviders()
    {
        if (!empty($this->providers)) {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * クラスエイリアスの登録
     *
     * @return void
     */
    protected function registerAliases()
    {
        if (!empty($this->aliases)) {
            $loader = AliasLoader::getInstance();

            foreach ($this->aliases as $alias => $facade) {
                $loader->alias($alias, $facade);
            }
        }
    }
}
