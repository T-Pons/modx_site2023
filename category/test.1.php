<?php
/*
 カテゴリ集計の予備実験
 MODXのminiBlogのコンテンツを舐めて、
 1.カテゴリーのリスト(というかjson)を作成。
 2.各カテゴリ名に、呼び出し側のコンテンツIDも持たせる
 3.コンテンツ個数もカウント
 4.mbのTOPに、テンプレート変数にでもして、できたJSONを書き出す
 予定。
*/
function count_ids(&$json , $head_text)
{
    //print_r($json);
    foreach( $json as &$i  ){
        printf($head_text);
        //print("{" . print_r($i ) . "}" );
        //var_dump($j); printf("====\n");
        printf( "[%s :" , $i[ "cat_name"] );
        $c=0;
        foreach( $i['used_id'] as &$j ){
            $c++;
            printf("%d,",$j);
        }
        $i['cat_count']=$c; 
        printf("]\n");
        count_ids($i['branch'] , $head_text."+=");
        $c=0;
        foreach( $i['branch'] as $k ){
            $c+=$k["cat_count"];
            $c+=$k["sub_count"];
        }
        $i['sub_count']=$c;
    }
    printf("\n");
}

$A='
[{
        "cat_name": "FirstCategory",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [3, 5, 26],
        "branch": []
    }, {
        "cat_name": "SecCategory",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [4],
        "branch": [ {
                "cat_name": "Sec_1",
                "cat_count": -1,
                "sub_count": -1,
                "used_id": [27, 35],
                "branch": []
            }, {
                "cat_name": "Sec_2",
                "cat_count": -1,
                "sub_count": -1,
                "used_id": [36, 42],
                "branch": []
            }, {
                "cat_name": "Sec_3",
                "cat_count": -1,
                "sub_count": -1,
                "used_id": [55, 56, 63],
                "branch": [{
                        "cat_name": "Sec_3_1",
                        "cat_count": -1,
                        "sub_count": -1,
                        "used_id": [75,89,95],
                        "branch": []
                    }
                ]
            }
        ]
    }
]
';

$B='[{
        "cat_name": "category_1st",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [33],
        "branch": []
    }, {
        "cat_name": "category_2nd",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [44],
        "branch": []
    }, {
        "cat_name": "cat_1st",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [44, 55, 66, 88],
        "branch": []
    }, {
        "cat_name": "category_3rd",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [55, 66, 77, 88],
        "branch": [{
                "cat_name": "test",
                "cat_count": -1,
                "sub_count": -1,
                "used_id": [55, 77],
                "branch": [{
                        "cat_name": "test2",
                        "cat_count": -1,
                        "sub_count": -1,
                        "used_id": [55],
                        "branch": []
                    }
                ]
            }
        ]
    }, {
        "cat_name": "category_4th",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [66],
        "branch": []
    }, {
        "cat_name": "category_5",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [77],
        "branch": []
    }, {
        "cat_name": "category_6",
        "cat_count": -1,
        "sub_count": -1,
        "used_id": [88],
        "branch": []
    }
]';

$D=json_decode($B,true);
//var_dump($D);
count_ids($D, "+=" );


echo json_encode($D);


?>
