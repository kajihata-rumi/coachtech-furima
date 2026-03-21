## アプリ名称

# coachtech-furima

## アプリ概要

Laravelを使用して作成したフリマアプリです。  
ユーザーは会員登録・ログイン後、商品一覧の閲覧、商品詳細の確認、商品出品、プロフィール編集を行うことができます。  
商品画像およびプロフィール画像のアップロードにも対応しています。

---

## 作成した目的

COACHTECHの模擬案件として、Laravelを用いたフリマアプリの設計・実装・テストを行うために作成しました。

---

## 開発範囲

- 設計
- コーディング
- テスト

---

## 使用技術

- PHP
- Laravel
- MySQL 8.0
- Docker / Docker Compose
- phpMyAdmin
- Blade
- CSS
- GitHub

---

## 対応ブラウザ

- Google Chrome 最新版
- Firefox 最新版
- Safari 最新版

---

## 環境構築

### Dockerビルド

1. リポジトリをクローンします。

```bash
git clone git@github.com:kajihata-rumi/coachtech-furima.git
```

2. 作業ディレクトリに移動します。

```bash
cd coachtech-furima
```

3. Dockerコンテナをビルドして起動します。

```bash
docker-compose up -d --build
```

---

## Laravel環境構築

1. PHPコンテナに入ります。

```bash
docker-compose exec php bash
```

2. パッケージをインストールします。

```bash
composer install
```

3. `.env` ファイルを作成します。

```bash
cp .env.example .env
```

4. アプリケーションキーを作成します。

```bash
php artisan key:generate
```

5. マイグレーションを実行します。

```bash
php artisan migrate
```

6. Seederを実行して初期データを投入します。

```bash
php artisan db:seed
```

7. 画像表示用のシンボリックリンクを作成します。

```bash
php artisan storage:link
```

---

## 動作確認までの最短手順

初めて環境構築する場合は、以下の順番で実行してください。

```bash
git clone git@github.com:kajihata-rumi/coachtech-furima.git
cd coachtech-furima
docker-compose up -d --build
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

---

## `.env` 設定

`.env` ファイルでは、以下のようにデータベース接続情報を設定してください。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

---

## storage:link が必要な理由

本アプリでは、商品画像およびプロフィール画像を `storage` に保存しています。  
そのため、ブラウザ上で画像を表示するには以下のコマンドを実行する必要があります。

```bash
php artisan storage:link
```

このコマンドを実行しない場合、画像が正しく表示されないことがあります。

---

## Seederについて

動作確認用としてSeederで初期データを登録しています。

### 登録内容

- ユーザー2名
- 商品データ10件

### 補足

- 新規ユーザーを作成した場合も機能は動作します。
- ただし、そのユーザーに紐づく出品データ・購入データがない場合、マイページの一覧は空表示になります。

---

## URL

- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/
- 出品画面: http://localhost/sell
- マイページ: http://localhost/mypage
- プロフィール編集画面: http://localhost/mypage/profile

※ 商品詳細画面など、他のURLはルーティングに応じて追記してください。

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
- 商品画像は `storage` に保存しています。
- 保存した画像は、商品一覧画面およびマイページで表示確認済みです。

### プロフィール画像アップロード機能

- プロフィール編集画面でプロフィール画像をアップロードできるように実装しています。
- プロフィール画像は `storage` に保存しています。
- 保存した画像は、プロフィール編集画面およびマイページで表示確認済みです。

### バリデーション

- 出品時のバリデーションは `ExhibitionRequest` を作成して実装しています。

---

## 画面確認手順

採点者の方は、以下の順で確認すると動作を追いやすいです。

### 1. トップページを確認

- 商品一覧が表示されることを確認してください。

### 2. ログインを確認

- Seederで登録されているユーザー情報でログインしてください。

### 3. 出品機能を確認

- `/sell` にアクセスしてください。
- 商品情報を入力してください。
- 商品画像を選択してください。
- 出品後、一覧画面またはマイページで反映を確認してください。

### 4. プロフィール編集を確認

- `/mypage/profile` にアクセスしてください。
- プロフィール画像を選択して保存してください。
- マイページで画像が表示されることを確認してください。

---

## ER図

![ER図](docs/er.png)

### ER図ファイルについて

- ER図画像ファイルは `docs/er.png` に配置しています。
- 編集元ファイルは `ER.drawio` です。

---

## テーブル一覧

- users
- items
- categories
- item_category
- conditions
- comments
- likes
- purchases

---

## テーブル設計

### usersテーブル

| カラム名          | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考             |
| ----------------- | --------------- | ----------- | ---------- | -------- | ----------- | ---------------- |
| id                | bigint unsigned | ○           |            | ○        |             | ユーザーID       |
| name              | varchar(255)    |             |            | ○        |             | ユーザー名       |
| email             | varchar(255)    |             | ○          | ○        |             | メールアドレス   |
| password          | varchar(255)    |             |            | ○        |             | パスワード       |
| profile_image     | varchar(255)    |             |            |          |             | プロフィール画像 |
| postal_code       | varchar(255)    |             |            |          |             | 郵便番号         |
| address           | varchar(255)    |             |            |          |             | 住所             |
| building          | varchar(255)    |             |            |          |             | 建物名           |
| email_verified_at | timestamp       |             |            |          |             | メール認証日時   |
| created_at        | timestamp       |             |            |          |             | 作成日時         |
| updated_at        | timestamp       |             |            |          |             | 更新日時         |

### itemsテーブル

| カラム名    | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考                         |
| ----------- | --------------- | ----------- | ---------- | -------- | ----------- | ---------------------------- |
| id          | bigint unsigned | ○           |            | ○        |             | 商品ID                       |
| user_id     | bigint unsigned |             |            | ○        | users(id)   | 出品者ID                     |
| name        | varchar(255)    |             |            | ○        |             | 商品名                       |
| brand_name  | varchar(255)    |             |            |          |             | ブランド名                   |
| description | text            |             |            | ○        |             | 商品説明                     |
| price       | integer         |             |            | ○        |             | 販売価格                     |
| condition   |                 |             |            |          |             | 実際のカラム型に合わせて記載 |
| image       | varchar(255)    |             |            |          |             | 商品画像                     |
| is_sold     | boolean         |             |            |          |             | 売却状態                     |
| created_at  | timestamp       |             |            |          |             | 作成日時                     |
| updated_at  | timestamp       |             |            |          |             | 更新日時                     |

### categoriesテーブル

| カラム名   | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考         |
| ---------- | --------------- | ----------- | ---------- | -------- | ----------- | ------------ |
| id         | bigint unsigned | ○           |            | ○        |             | カテゴリーID |
| name       | varchar(255)    |             |            | ○        |             | カテゴリー名 |
| created_at | timestamp       |             |            |          |             | 作成日時     |
| updated_at | timestamp       |             |            |          |             | 更新日時     |

### item_categoryテーブル

| カラム名    | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY    | 備考         |
| ----------- | --------------- | ----------- | ---------- | -------- | -------------- | ------------ |
| id          | bigint unsigned | ○           |            | ○        |                | ID           |
| item_id     | bigint unsigned |             |            | ○        | items(id)      | 商品ID       |
| category_id | bigint unsigned |             |            | ○        | categories(id) | カテゴリーID |

### commentsテーブル

| カラム名   | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考         |
| ---------- | --------------- | ----------- | ---------- | -------- | ----------- | ------------ |
| id         | bigint unsigned | ○           |            | ○        |             | コメントID   |
| user_id    | bigint unsigned |             |            | ○        | users(id)   | ユーザーID   |
| item_id    | bigint unsigned |             |            | ○        | items(id)   | 商品ID       |
| content    | text            |             |            | ○        |             | コメント内容 |
| created_at | timestamp       |             |            |          |             | 作成日時     |
| updated_at | timestamp       |             |            |          |             | 更新日時     |

### likesテーブル

| カラム名   | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考       |
| ---------- | --------------- | ----------- | ---------- | -------- | ----------- | ---------- |
| id         | bigint unsigned | ○           |            | ○        |             | いいねID   |
| user_id    | bigint unsigned |             |            | ○        | users(id)   | ユーザーID |
| item_id    | bigint unsigned |             |            | ○        | items(id)   | 商品ID     |
| created_at | timestamp       |             |            |          |             | 作成日時   |
| updated_at | timestamp       |             |            |          |             | 更新日時   |

### purchasesテーブル

| カラム名       | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考       |
| -------------- | --------------- | ----------- | ---------- | -------- | ----------- | ---------- |
| id             | bigint unsigned | ○           |            | ○        |             | 購入ID     |
| user_id        | bigint unsigned |             |            | ○        | users(id)   | 購入者ID   |
| item_id        | bigint unsigned |             | ○          | ○        | items(id)   | 商品ID     |
| payment_method | varchar(255)    |             |            | ○        |             | 支払い方法 |
| postal_code    | varchar(255)    |             |            | ○        |             | 郵便番号   |
| address        | varchar(255)    |             |            | ○        |             | 住所       |
| building       | varchar(255)    |             |            |          |             | 建物名     |
| purchased_at   | timestamp       |             |            |          |             | 購入日時   |
| created_at     | timestamp       |             |            |          |             | 作成日時   |
| updated_at     | timestamp       |             |            |          |             | 更新日時   |

### conditionsテーブル

| カラム名   | 型              | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY | 備考       |
| ---------- | --------------- | ----------- | ---------- | -------- | ----------- | ---------- |
| id         | bigint unsigned | ○           |            | ○        |             | 商品状態ID |
| name       | varchar(255)    |             |            | ○        |             | 商品状態名 |
| created_at | timestamp       |             |            |          |             | 作成日時   |
| updated_at | timestamp       |             |            |          |             | 更新日時   |

---

## ディレクトリ構成

```text
src
├── app
│   ├── Http
│   │   ├── Controllers
│   │   └── Requests
│   ├── Models
├── database
│   ├── migrations
│   └── seeders
├── docker
├── public
├── resources
│   ├── views
│   └── css
├── routes
│   └── web.php
└── storage
```

---

## 注意事項

- 画像表示を行うため、`php artisan storage:link` の実行が必要です。
- Seeder実行前提で動作確認を行っています。
- 新規ユーザーでは、初期状態のマイページ一覧が空になる場合があります。
- CSSは一部調整中の箇所がありますが、機能確認は可能です。

---

## 今後の実装予定

- 購入処理の仕上げ
- UI / CSS調整
- READMEの最終調整
