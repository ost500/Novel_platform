<?php

use Illuminate\Database\Seeder;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Keyword::truncate();

        $keyword1 = ['현대', '현대판타지', '시대', '사극', '동양판타지', '서양역사', '로맨스판타지'];
        $keyword2 = ['메디컬로맨스', '전문직로맨스', '캠퍼스로맨스', '학원로맨스', '할리퀸로맨스', '스포츠', '연예계'];
        $keyword3 = ['차원이동', '타임슬립', '기억상실', '남장여자', '병/장애', '전생/환생', '복수', '스캔들', '영혼체인지', '회귀물'];
        $keyword4 = ['계약관계', '나이차커플', '동거', '맞선', '사내연애', '사제지간', '삼각관계', '원나잇', '재회물', '정략결혼', '짝사랑', '첫경험', '첫사랑', '친구/연인', '선후배'];
        $keyword5 = ['계략남', '까칠남', '나쁜남자', '능글남', '다정남', '동정남', '상처남', '소유욕', '순정남', '황제', '황태자/왕자', '왕족/귀족', '연하남', '절륜남', '재벌남', '카리스마남', '후회남'];
        $keyword6 = ['철벽녀', '무심녀', '후회녀', '왕족/귀족', '공주/황녀', '황제', '까칠녀', '다정녀', '동정녀', '순정녀', '사이다녀'];
        $keyword7 = ['로맨틱코미디', '달달물', '힐링물', '피폐물', '신파', '잔잔물', '애잔물', '미스테리/스릴러'];

        //For keyword1
        foreach ($keyword1 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 1;
            $keyword->name = $key;
            $keyword->save();
        }
        //For keyword2
        foreach ($keyword2 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 2;
            $keyword->name = $key;
            $keyword->save();
        }
        //For keyword3
        foreach ($keyword3 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 3;
            $keyword->name = $key;
            $keyword->save();
        }
        //For keyword4
        foreach ($keyword4 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 4;
            $keyword->name = $key;
            $keyword->save();
        }

        //For keyword5
        foreach ($keyword5 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 5;
            $keyword->name = $key;
            $keyword->save();
        }

        //For keyword6
        foreach ($keyword6 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 6;
            $keyword->name = $key;
            $keyword->save();
        }
        //For keyword7
        foreach ($keyword7 as $key) {
            $keyword = new \App\Keyword();
            $keyword->category = 7;
            $keyword->name = $key;
            $keyword->save();
        }


    }
}
