#楽譜共有システム（仮）

##環境構築手順

コンテナの起動
```
./vendor/bin/sail up -d
#または
docker-compose up -d
```

コンテナに入る
```
docker exec -it score-share_laravel.test_1 bash
```

composer インストール
```
composer install
```

npmインストール
```
npm install
```

マイグレーションの実行
```
php artisan migrate:refresh --seed
```

node起動

```
npm run watch
```
または
```
mix watch
```


