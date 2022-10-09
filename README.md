# GamersMeeting
 
ゲーム好きな人が一緒に遊ぶ仲間を探すことができるマッチングアプリ  
自身がゲーム好きであり、一緒にゲームを遊ぶ仲間を探すことが難しいと感じたことからこのアプリケーションの開発に取り組む.   
仲間を探したいゲームを選択し、プロフィールを設定した後マッチング画面に出てくる人をGood or Badで選択できる.  
お互いにGoodを選択した人同士でマッチングした後にはチャットで連絡を取ることも可能.  
  
# DEMO
お試しの際は[こちら](https://quiet-brook-84844.herokuapp.com/)より   
   
email:demo@a.com   
password: 11111111     
   
にてログインください   
デモとしてランダムデータを50人分追加しています。既にGoodされているのですぐにマッチングできます。
___
   登録画面(メールアドレスかLINEログインのどちらかで登録できる) 
![sample5](https://user-images.githubusercontent.com/105817239/193942001-0429a632-3108-40e3-beab-3f559c0a1a9d.png)   
   マッチング画面(ハートマークがGoodバツマークがBadでそれぞれクリックして選択できる) 
![sample1](https://user-images.githubusercontent.com/105817239/193941988-22fe12a4-0ad4-4b53-a45c-67c135dd4839.png)   
   チャット画面(マッチング相手それぞれと一対一でチャットができる)
![sample2](https://user-images.githubusercontent.com/105817239/193941992-bc95440b-d98e-4c92-9ba7-d3b6717dff78.png)   
   プロフィール設定画面(各プロフィールやマッチしたいゲームを選択・変更できる)   
![sample4](https://user-images.githubusercontent.com/105817239/193941994-44859e61-bb90-4ebb-9f18-d27dfa3f7fef.png)   
 
# Futures
- マッチング機能
- ログイン機能＆LINEログイン
- リアルタイムチャット機能
- マイページ＆プロフィール変更機能
- 通知機能
 
# Future features
- [ ] 管理者ページの追加(新ゲームの追加などを行う)
- [ ] ゲーム別プロフィールの設定
- [ ] マッチング通知をLINEに通知
- [ ] チャット機能の強化(画像やファイルなどを送れるようにする)
- [ ] チャットのメッセージを全件取得から最新の何件かを取得するように変更する
 
# Requirement
 
php ^7.2.5|~8.0   
doctrine/dbal ^3.4   
fruitcake/laravel-cors ^2.0   
guzzlehttp/guzzle ^7.0.1   
laravel/framework ^8.75   
laravel/sanctum ^2.11   
laravel/tinker ^2.5   
pusher/pusher-php-server ^7.0   
laravel/ui 3.*   
 
# Installation
 
GitHubからファイルをクローン
```bash
https://github.com/keigo64721/GamersMeeting.git
```
venderファイルとcomposer.lockを作成
```bash
cd GamersMeeting/
composer install
```
.envファイルを作成
```bash
cp .env.example .env
```
.envファイル内の項目を変更してデータベースを有効化
```bash
DB_DATABASE=<使用するデータベース名>
DB_USERNAME=<ユーザーの名前>
DB_PASSWORD=<データベースのパスワード>
```   
.envファイル内の項目を変更してpusherを有効化(pusherのApp Keysを設定)
```bash
BROADCAST_DRIVER=pusher

PUSHER_APP_ID=<App Keysのapp_id>
PUSHER_APP_KEY=<App Keysのkey>
PUSHER_APP_SECRET=<App Keysのsecret>
PUSHER_APP_CLUSTER=<App Keysのcluster>
```
.envファイル内の項目を追加してLineLogin機能を有効化(LineLoginAPI)
```bash
LINE_CHANNEL_ID=<LineLoginAPIのチャンネルID>
LINE_CHANNEL_SECRET=<LineLoginAPIのチャンネルシークレット>
LINE_REDIRECT=<LineLoginAPIのコールバックURL> #https://ドメイン/callbackの形
```
アプリケーションキーを作成
```bash
php artisan key:generate
```
マイグレーションを実行
```bash
#通常のマイグレーション
php artisan migrate

#シーダーも行うマイグレーション
php artisan migrate --seed
```
ストレージをリンク
```bash
php artisan storage:link
```

# Usage
起動する
```bash
php artisan serve --port=8080
```

# Note
 現在作成中のアプリケーションのため、不具合を見つけた際には下記の連絡先までご連絡ください
 
# Author
 
* 作成者: 相澤圭胡
* 所属: 中央大学理工学部情報工学科
* E-mail: k5k5.azw64@gmail.com
 
# License
"GamersMeeting" is under [MIT liicense](https://en.wikipedia.org/wiki/MIT_License)
 
