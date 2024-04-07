# modx_site2023
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
最低限のメモ書きは残したい。

## 外部のファイル
<dl>
  <dt>CMS textile の perser.php</dt>  <dd>旧版だと textile.phpだった。
    textile表記を、HTMLにパースできる。新版だと装飾やら色やら、事実上CSSを書き込める。高機能。
    </dd>
  <dt>SyntaxHighlighter</dt> <dd>これまた新版だと高機能化。もっとも旧版も残ってて使えるし、
    cdnなので急に無くなるはずもなし。もう旧版でいいか。 </dd>
</dl>

## スニペット解説
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
ページ転送。

#### print_request
つかったらダメ。開発中のデバックや調査用。使い終わったらちゃんと殺しとく

#### esc_html
調査用。急場で実体参照とか判らん場合に、これに渡して表示させて見ると、早かったり。

### ページリンク
プレースホルダーとテンプレートの利用例？

### ページリンク

### 単体機能
ヘッダでscript読み込む奴が多い。おなじみLoadシリーズ。

### OGP関連
FaceBookやtwitter、blogでのbox式リンク等で使われるやつ。

実は、headセクションで上から2KB以内とか、謎ルールがある。
### image-compare-viewer関連
画像比較。完成品こそ一個だが、苦戦したので中途も残す。デバック方法の参考で

### simplepie関連
rss検索。ただし簡易。

毎回検索する、あまりよくない作り。
本当は中間ファイルを出力してキャッシュ利用すべきかも。

### Youtube_IO
ぶっちゃけ未完成。

###touch_シリーズ。
コンテンツの情報書き換えにチャレンジ。
日付管理ができるため、自作の日記システムの部品でもある。


### blog
自作の日記システム。URLを調べて動作を変える（ルーティング）のをはじめ、
結構な技を覚えるハメに。

やっぱり手を動かさないと覚えないよね！

### LoadZoomify
超解像技術！ なんかVerが上がってた！
flash時代のが、高機能だった気もするが、時代の流れ。



