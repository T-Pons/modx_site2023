<?php
/*
 カテゴリーには、"/"と"," は利用できない。
 "\"もだめ。["]  [']  [`] なども、使えない。
 スペースや改行は、画面が崩れるため、利用しないほうが良い
 再起版。
 categoryを / でセパレートして、親から子へ全部id追加。
 ダブりは追加せず。
 末尾の/はどうすっか。
*/
function add_id_rec(&$json, $id, $cat_name,$cat_sub)
{

    //print_r($i.":");
    $res = array_search($cat_name , array_column($json,'cat_name') );
    //printf("[Search:%s:%d]\n",$i,$res);
    if(!is_bool($res) ){ /* カテゴリーがあり。id追加 */
        printf("find[%s]\n",$cat_name);
        if(!in_array($id , $json[$res]["used_id"]))  $json[$res]["used_id"][] = $id;
    } else{
        /* カテゴリー無し->追加 */
        //printf("notF[%s]\n",$i);
        $adder=array( "cat_name" => $cat_name, "cat_count" => -1, "sub_count"=> -1, "used_id"=> [ $id ], "branch"=> [] );
        $json[]=$adder;
    };

    if( empty($cat_sub) ){
        /* 子なし=再起なし */
    }else{
        $sep_pos = mb_strpos( $cat_sub,"/");
        if( ! $sep_pos ){
            $head = $cat_sub;
            $tail = "";
        }else{
            $head    = mb_substr( $cat_sub , 0, $sep_pos );
            $tail    = mb_substr( $cat_sub , $sep_pos + 1 );
        }
        printf("{%s = %s:%s}\n", $cat_sub , $head , $tail );
        $res = array_search($cat_name , array_column($json,'cat_name') ); /* 上で追加してるので絶対ある */
        add_id_rec($json[$res]["branch"], $id, $head, $tail);
    }

}

function add_id(&$json, $id, $caterogy)
{
    //print_r($json);
    $cat_single = mb_split("," , $caterogy);
    //print_r($cat_single);
    foreach( $cat_single as $i ) {
        $sep_pos = mb_strpos( $i,"/");
        if( ! $sep_pos ){
            $head = $i;
            $tail = "";
        }else{
            $head    = mb_substr( $i , 0, $sep_pos );
            $tail    = mb_substr( $i , $sep_pos + 1 );
        }
        printf("[%s = %s:%s]\n", $i , $head , $tail );
        add_id_rec($json, $id, $head,$tail);
    };
    //printf("\n");
};

$json_data=json_decode("[]",false);

 add_id($json_data , 33 , "category_1st");                        /* 基礎。1カテ 新規 tree無し */
 add_id($json_data , 44 , "category_2nd,cat_1st");                /* 複数個対応 */
 add_id($json_data , 55 , "category_3rd/test/test2,cat_1st");     /* tree対応 */
 add_id($json_data , 66 , "category_4th,cat_1st,category_3rd");   /* ダブり処理 */
 add_id($json_data , 77 , "category_5,category_3rd/test");        /* treeのダブり処理 */
 add_id($json_data , 88 , "category_6,cat_1st,cat_1st,cat_1st,category_3rd"); /* ダブり処理余剰が無いように */

print_r($json_data);

echo json_encode($json_data);
?>
