# modx_site
since 2023-2025
## 概要
test site fot modx
2023年度版のMODXテストサイトのバックアップ。
旧サイトのDBを保管してたはずだが、DB見るのが面倒だったという。
サイト情報でも、githubに保管してる例があったので、便利使いさせてもらおうかと。

## なぜ公開？
自分で忘れないように(苦笑)

## その他
備忘録として、Notionを利用し始めてる。
便利なんだが、単一リソースだと不安もある。
最低限のメモ書きは別環境にも残したい(=ここ)
MODX備忘録的な？

## 自作ツールや使いこなしやなんやら

## 外部のファイルやサービスやら
<dl>
  <dt>CMS textile の perser.php</dt>  <dd>旧版だと textile.phpだった。
    textile表記を、HTMLにパースできる。新版だと装飾やら色やら、事実上CSSを書き込める。高機能。
    </dd>
  <dt>SyntaxHighlighter</dt> <dd>これまた新版だと高機能化。もっとも旧版も残ってて使えるし、
    cdnなので急に無くなるはずもなし。もう旧版でいいか。 </dd>
  <dt>超解像画像</dt> <dd>なんか旧Flashだったzoomify。機能は下がってるが、Ver5でJavascriptで動作してる。
   free版もできてるし「採用！」で</dd>
  <dt>画像比較</dt> <dd>いろいろあるが、こいつに。一ページに複数置けるとか、設定JSONでまとめておけるとかメリット多し</dd>
  <dt>掲示板？</dt> <dd>DisQuasが優秀なんで、それでいいかと</dd>
</dl>

## 自作系スニペット解説
### 簡単なヤツ。「1行野郎」に相当
デバック情報や、ベンチマーク機能を叩いたり。
簡単だが、意外とドキュメントが無くてオタ付く事がある。
#### phpcredits 
#### phpextensions 
#### phpinfo 
ベンチマーク関数とデバック情報類。性能しらべたりできる。
phpinfoは通常停止されてるので、動作しない方が普通の環境。

#### redirect
#### blog_safe 
ページ転送。色々調べたり、ソース読んだりして、blog_sage作ったら、
なんと githubで色々コレクションしてる人がいてな。ガーン。

#### print_request
つかったらダメ。開発中のデバックや調査用。使い終わったらちゃんと殺しとく

#### esc_html
調査用。急場で実体参照とか判らん場合に、これに渡して表示させて見ると、早かったり。

### ページリンク
OGPのリンク作成用の試作。ShareHtmlの方が完成型。
ただ、プレースホルダーとテンプレートのテストとして意味が残ってるので単品でも残し。

### 単体機能
ヘッダでscript読み込む奴が多い。
おなじみLoadシリーズとか、簡単だが実は有能。
とくに、&lt;head&gt; 内部に、コンテンツ側から文面を追加できるのは超使える。
これだけでmodx利用する理由になるぐらい。
regClientStartupHTMLBlock！神

### touch_シリーズ。
コンテンツの情報書き換えにチャレンジ。
日付管理ができるため、miniblog(自作の日記システム)の部品でもある。
#### touch_createdon
#### touch_editedon
#### touch_publishedon
コンテンツ内部に記述しておいて、各要素を更新掛ける。
記述→一回表示→削除と、微妙に面倒。
だが、逆に考えると、DBを自由に更新できるわけで、
コレ、かなり無理が効く技法。
実はmodxの内部DBを更新するの、初めてで、
今後の機能増強前の準備としても面白かった。


### OGP関連
FaceBookやtwitter、blogでのbox式リンク等で使われるやつ。
実は、meta社facebookは、headの頭2KB以内に無いとまともに動作しない謎ルールがある。
（しかも、資料やVerによって書いてある内容が違う！1KBとか2KBとか4KBとか）
おなじみのregClientStartupHTMLBlockでの出力は使えない(javascriptなど読み込むと、2KBなんて突破しちまう。)
ページリンク.snipetはここの試作。ShareHtmlの方が完成型。

####  in_template_OGP
スニペットだが、テンプレート内に配置して使う。
blog用コンテンツの時だけ有効にするとか。いろいろできるなMODX

####  setOGP
試験用で残ってるだけ。固定値をヘッダに足して、facebook側の動作とか確認してた。
試験用に残してあるが、実際には使用しない。

#### test_OGP_固定 
こちらも試験用で残ってる。いろんな値を足して、挙動を見てただけ。(バックアップすら不要？)

#### ShareHtml(snippet)+(content 170)ShareHtmlを、もっと綺麗にしたメーカー
よそ様のページのOGPを読み取り、カード形式で表示する。
公開ページというより、自分で利用して、リンク用のhtml手に入れる感じ。
よそサイトの複製だったのが、だんだん自作javascript分が多くなっちゃって別物に。

### image-compare-viewer関連
画像比較。完成品こそ一個だが、苦戦したので中途も残す。デバック方法の参考で

 パラメーターは img1="画像URL1" img2="画像URL2"
 各種設定は .image-compareを付けたエレメントに、 icv_cfg="設定" をする
 
#### load_ICViewer
おなじみLoadシリーズ。regClientStartupHTMLBlockでjavascript準備

#### exe_ICViewer
こちらは、廃止！
&lt;body&gt; 中に置く。コンテンツ最後に在ればいい模様。
いろいろ工夫してたのだが、意外と設定内容が多い。
結局コンテンツ内でjsonと設定のベタ書きが使い易かった模様。


### simplepie関連
rss検索。ただし簡易。

毎回検索する、あまりよくない作り。
本当は中間ファイルを出力してキャッシュ利用すべきかも。

### Youtube_IO
ぶっちゃけ未完成。

### 楽譜関連
未完成というか、未作成。画像をその都度生成するのは負荷ありそうだが、
MODX自体が[ユーザーが作ったコンテンツ]→[HTMLとかレンダリング]をキャッシュする作りになってない。
MediaWikiみたいにキャッシュできるCMSを別に用意して、APIで内容引き出すほうが筋がよさそう。

多数の曲情報とかも、MODXのTree管理では無理が出るし

### MediaWiki APIたたき
楽譜=Lilypondとか、変換が重い系コンテンツの扱いで、全部MODX化よりよさそうかな？と。
あとカテゴリとかTree分類以上の機能が欲しい場合もMODXの手に余るというか。

やたら高機能だもんな。

### 自作の blogシステム
自作の日記システム。URLを調べて動作を変える（ルーティング）のをはじめ、
結構な技を覚えるハメに。

やっぱり手を動かさないと覚えないよね！

コンテンツ置き場(現状id=53) とツール置き場(id=52)に分かれてる。
名前はminiBlogとして
- URL分解。コンテンツ自体 or 月 or Category (or Adminページ) かな？
- Categoryは作成中。

blog_safeは上↑で

#### miniBlog_content 
miniBlogの本体。
URLを調べる。
デザイン類は、コンテンツ側で設計する。
例:普通のblogなら右上はカレンダーで良いが、動画紹介なら、動画サイト/投稿チャンネル/日付 などの、テンプレートが上にしたい。

 1.URLを調べる
 2.xxx/53?[MVC]=xx になっているか調べる(Monthy/View Content/Category)C 
   // ダメなら M=[今月] にリダイレクト? → カレンダーは今月＋最終10記事 表示に 変更する。
   書式は M=2024/04 型
   W(ライター)も追加したいかも。P(最新ページ？)は要らないかな？
 2.99.*** パラメータ不備＆エラー時は、リダイレクト実行。$red_err =  MODX_BASE_URL .'/51?M=' . date("Y/m")  );
      $modx->sendRedirect( $red_err );

 3.プレースフォルダ[+mb_month+]に、月を設定。M→指定月 V→記事のid C→カテゴリ内で最終記事の月
 　[+mb_vid+]とか、[mb_vdate]とかも追加必要かもしれん。
  
 4.MVCで動作。優先度は A → V → M → C 。 記事が増えてもページネーションは不要かもしれん。（本気で増えたら後で考える）
   Adminページは、仕様決めかね。そのうち考える
   
 5.V 単一コンテンツ表示。
 [+mb_month+]設定後、ディスクりプションと、本文とを表示
 blog用のヘッダデザインや、前後の記事へのリンクが必要。日付前後とカテゴリリンクは欲しい。
 関連カテゴリの最新記事と直近過去記事も出したいし。
 
 6.M 該当月のコンテンツ一覧 
 　→ 現状、問題多し。最低でも該当月 直近 10コンテンツとか表示すべき？
   → 同一日、複数コンテンツには対応しないと。
   → 記事多数時に、ページネーションが必要。 dittoじゃなくて、自前で処理がぁぁ
   デザインヘッダ＆ディスクりプション表示、考えないとな。
   
 7.C 該当カテゴリー一覧 : 終了
 
#### category_col
コンテンツ全部をナメて調べて、カテゴリー一覧を作成 → 集計ページの*content*を更新する
集計内容は、jsonとして、"カテゴリ名" [0以上の配列でコンテンツid] にする。

#### print_cal_dummy
#### debug_print_cal
#### print_cal 
blog 内部コンテンツ用スニペット。 カレンダーを表示する。 表示日時は、プレースホルダ利用。

#### print_category カテゴリー一覧を表示。 単純な出力
#### print_cat_dummy カテゴリー一覧を表示。 単純な出力
未完成 表示する度、id数えて表示内容作る。

print_page_dummy カテゴリー一覧を表示。 単純な出力

#### H2
当初考えてたblog用ヘッダ。
良く考えたら画像ヘッダとか必要だし、一覧表示ならディスクリプション側表示だし、
本文中でH2使う事ないやん！。

まぁデザインのプロトタイプにはなったし、無駄じゃないか。

### LoadZoomify
超解像技術！ なんかVerが上がってた！
flash時代のが、高機能だった気もするが、時代の流れ。

### ac
アコーディオン表示。
おなじみの、折り畳める表示部品。多用しそうなので、あえて短い名前で。
ネストも可能。表記は以下
 ```
[[ac? &title='入れ子の試験' &msg='
ここが総親。入れ子になっても問題なく動作するハズ<br>
    ((ac? title=--子要素-- msg=--  
       ((ac? title=--孫要素1-- msg=--
      　  孫要素1 = 一個目<br>
       -- ))
        入れ子になっても問題なく動作するハズ<br>
       ((ac? title=--孫要素2-- msg=--
      　  孫要素1 = 二個目<br>
         ((ac? title=--ひ孫要素-- msg=--
      　    ひ孫！手動では面倒だよね<br>
         -- ))
       -- ))
   -- ))
']]
 ```
かなり変？

$modx->evalSnippetを見つけたのがミソだった模様。

`[[]]`が使えないので、ネストの中は `(( ))` として、 「 ' 」も使えないから `--` で代用。

ネストの解除法は、
- 最「後」の((を見つけて
- その位置から後ろに最近の))を見つけて
- 文字列置き換えて、evalSnippetする
を再起でなくなるまで呼び続ける形。

結果として、他のスニペットも内部に書けるようにはなった。


<!-- EOT -->
