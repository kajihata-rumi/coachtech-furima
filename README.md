# coachtech-furima

## アプリ概要

Laravelを使用して作成したフリマアプリです。
ユーザーは会員登録・ログイン後、商品一覧の閲覧、商品詳細の確認、商品出品、プロフィール編集を行うことができます。
商品画像およびプロフィール画像のアップロードにも対応しています。

---

## 環境構築

### Dockerビルド

- `git clone git@github.com:kajihata-rumi/coachtech-furima.git`
- `cd coachtech-furima`
- `docker-compose up -d --build`

### Laravel環境構築

- `docker-compose exec php bash`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`

---

## .env 設定

`.env` ファイルでは、以下のデータベース接続情報を設定してください。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

---

## Seederについて

動作確認用としてSeederで初期データを登録しています。

### 登録内容

- ユーザー2名
- 商品データ10件

### 補足

- 新規ユーザーを作成した場合も機能は動作します。
- 新規ユーザーに紐づく出品データ・購入データがない場合、マイページの一覧は空表示になります。

---

## URL

- 開発環境: `http://localhost/`
- phpMyAdmin: `http://localhost:8080/`
- 出品画面: `http://localhost/sell`
- マイページ: `http://localhost/mypage`
- プロフィール編集画面: `http://localhost/mypage/profile`

---

## 使用技術（実行環境）

- PHP 8.x
- Laravel 8.x
- MySQL 8.0
- nginx 1.21.x
- Docker / Docker Compose

---

## 主な機能

- 会員登録
- ログイン
- ログアウト
- 商品一覧表示
- 商品詳細表示
- 商品出品
- 商品画像アップロード
- プロフィール編集
- プロフィール画像アップロード
- マイページ表示
- いいね機能
- コメント機能

---

## 実装済み内容

### 商品画像アップロード機能

- 出品時に商品画像をアップロードできるように実装しています。
- 商品画像は storage/app/public/items に保存しています。
- 保存した画像は、商品一覧画面およびマイページで表示確認済みです。

### プロフィール画像アップロード機能

- プロフィール編集画面でプロフィール画像をアップロードできるように実装しています。
- プロフィール画像は storage/app/public/profiles に保存しています。
- 保存した画像は、プロフィール編集画面およびマイページで表示確認済みです。

---

### バリデーション実装ファイル

- ユーザー登録時: `src/app/Http/Requests/RegisterRequest.php`
- ログイン時: `src/app/Http/Requests/Auth/LoginRequest.php`
- コメント時: `src/app/Http/Requests/CommentRequest.php`
- 支払時: `src/app/Http/Requests/PurchaseRequest.php`
- 配送時: `src/app/Http/Requests/AddressRequest.php`
- プロフィール登録時: `src/app/Http/Requests/ProfilesRequest.php`
- 商品登録時: `src/app/Http/Requests/ExhibitionRequest.php`

---

## ER図

![ER図](docs/er.png)

---

## 注意事項

- 画像表示を行うため、`php artisan storage:link` の実行が必要です。
- Seeder実行前提で動作確認を行っています。
- 新規ユーザーでは、初期状態のマイページ一覧が空になる場合があります。
