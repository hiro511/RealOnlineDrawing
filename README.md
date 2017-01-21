# お絵かきチャットサービス

## 動作要件
- Docker
- Docker Compose
- Google Chrome

## 環境構築手順
1. Gitからファイル一式をダウンロード
2. ディレクトリで`$ docker-compose up`を実行
3. 80番ポートでWebサーバが動作しているので，Google Chromeからlocalhostにアクセスすることでサービスを使用できます．
4. サービスの停止は`Ctrl+C`．`$ docker-compose rm`でコンテナを削除できます．

## システム仕様
- サーバー
  - Docker
  - Docker Compose
  - PHP
  - FuelPHP
  - MySQL
- クライアント
  - HTML
  - JavaScript
