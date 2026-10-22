# MOS学習記録アプリ

## 概要

MOS（Microsoft Office Specialist）の資格取得に向けた学習を記録・管理するWebアプリケーションです。

日々の学習時間や模擬試験の結果を記録し、学習状況を可視化することで、継続的な学習をサポートします。

## 主な機能

- **ユーザー認証**：ユーザー登録・ログインなどの認証機能
- **学習記録の管理**：学習記録の登録・一覧表示・編集・削除
- **学習カテゴリの管理**：MOSの科目など、学習カテゴリごとの記録
- **模擬試験結果の記録**：試験時間や正答率の記録
- **ダッシュボード**：学習状況や週間の学習実績の確認
- **週間目標の進捗管理**：設定した週間目標に対する達成状況の確認
- **高得点の確認**：模擬試験で高い正答率を達成した記録の確認
- **ページネーション**：学習記録を複数ページに分けて表示

## 使用技術

| 技術 | 内容 |
|---|---|
| PHP | 8.5 |
| Laravel | 13 |
| MySQL | 8.4 |
| Laravel Sail | Docker開発環境 |
| HTML / CSS | 画面構築 |
| JavaScript | フロントエンド処理 |
| Tailwind CSS | CSSフレームワーク |
| Vite | フロントエンドの開発環境 |

### Docker構成

- Laravelアプリケーション：`laravel.test`
- データベース：MySQL
- キャッシュなど：Redis
- 検索エンジン：Meilisearch
- メールのテスト環境：Mailpit
- ブラウザテスト環境：Selenium

※上記のサービスは開発環境の構成です。すべてがアプリケーションの画面機能として使用されていることを意味するものではありません。

## 学習記録の項目

| 項目 | 内容 |
|---|---|
| 学習日 | 学習を行った日付 |
| カテゴリ | 学習したMOSの科目など |
| 模擬試験タイム | 模擬試験にかかった時間 |
| 学習時間 | 学習に費やした時間 |
| 正答率 | 模擬試験の正答率 |
| メモ | 学習内容や振り返り |

## セットアップ方法

### 1. リポジトリをクローン

```bash
git clone <リポジトリのURL>
cd mos_record_app
```

### 2. 環境設定ファイルを作成

```bash
cp .env.example .env
```

`.env` ファイルの設定を確認してください。

Docker Composeの構成に合わせ、データベース接続情報は基本的に以下のように設定します。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

※上記は設定例です。実際の `.env.example` に記載された値や、Dockerの環境変数設定に合わせてください。

### 3. Composerの依存関係をインストール

ホスト環境にPHPとComposerがインストールされている場合は、以下を実行します。

```bash
composer install
```

※初回クローン時には `vendor` ディレクトリが存在しないため、Sailの起動前に依存関係をインストールする必要があります。

### 4. Dockerコンテナを起動

```bash
./vendor/bin/sail up -d --build
```

Laravel Sailを使用して、アプリケーションに必要なDockerコンテナを起動します。

### 5. アプリケーションキーを生成

```bash
./vendor/bin/sail artisan key:generate
```

### 6. データベースを準備

```bash
./vendor/bin/sail artisan migrate
```

マイグレーションを実行し、必要なテーブルを作成します。

### 7. フロントエンドの依存関係をインストール

```bash
./vendor/bin/sail npm install
```

### 8. フロントエンドの開発サーバーを起動

```bash
./vendor/bin/sail npm run dev
```

開発サーバーを起動した状態で、ブラウザからアプリケーションにアクセスします。

```text
http://localhost
```

※ポート番号を変更している場合は、`.env` の `APP_PORT` に設定したポート番号を使用してください。

## 開発環境の停止

Dockerコンテナを停止する場合は、プロジェクトのルートディレクトリで以下を実行します。

```bash
./vendor/bin/sail down
```

## 制作目的

MOS資格取得に向けた学習を継続し、学習時間や模擬試験の結果を振り返りやすくすることを目的に制作しました。

Laravelを使用したWebアプリケーションの開発を通じて、データベース設計、CRUD処理、ユーザー認証、データ集計、Dockerを利用した開発環境の構築について学習しました。

