# ライブ会場検索

## 概要

ライブ会場を選択すると、該当のライブ会場の詳細とユーザーの口コミが確認できるWebアプリケーションです。

## 機能

### ライブ会場検索ページ

- 全国のライブ会場をセレクトボックスから選択
- 選択した会場の詳細情報を表示
  - 収容人数
  - 最寄り駅・アクセス
  - トイレ情報（女性用・男性用・バリアフリー）
  - Google Maps リンク

## 技術スタック

- **バックエンド**: Laravel 12 / PHP 8.4
- **フロントエンド**: React 19 + TypeScript / Inertia.js v2
- **スタイリング**: Tailwind CSS v4
- **データベース**: MySQL

## セットアップ

### 必要環境

- Docker（Laravel Sail）

### インストール手順

```bash
# リポジトリをクローン
git clone <repository-url>
cd live

# 依存パッケージをインストール
composer install
npm install

# 環境変数の設定
cp .env.example .env

# Sailを起動
./vendor/bin/sail up -d

# アプリケーションキーを生成
./vendor/bin/sail artisan key:generate

# マイグレーションとシードを実行
./vendor/bin/sail artisan migrate --seed

# フロントエンドをビルド
npm run build
```

### 開発環境の起動

```bash
composer run dev
```

## 今後実装予定の機能

### ユーザー認証機能

- 会員登録・ログイン・ログアウト
- 認証済みユーザーのみ口コミ投稿が可能

### 口コミ投稿ページ

- テキスト内容
  - 交通
  - 食事
  - 音響
  - その他
- 画像アップロード（1枚のみ）
- 評価（星評価など）

### 会場ランキング機能

- 口コミの評価をもとに会場をランキング表示

### 会場＆日付検索機能

- 会場名・都道府県での絞り込み検索
- 日付指定での検索
- **宿泊ホテル表示**: 日付検索時に「宿泊予定」チェックを付けると、会場周辺のホテルを表示
  - [楽天トラベルAPI](https://webservice.rakuten.co.jp/) を使用予定

### 終電検索機能

- 会場最寄り駅から自宅最寄り駅までの終電時刻を検索・表示


## テスト

```bash
./vendor/bin/sail artisan test --compact
```
