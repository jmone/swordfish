package main

import(
	"fmt"
	"sort"
)

type DocScore struct{
	Id Docid
	Score int
	Price float64
}
type ScoreList []DocScore
type DocScoreMapping map[Docid]int

var docScoreMapping DocScoreMapping
var scoreList ScoreList

func init(){
	docScoreMapping = make(DocScoreMapping)
}

//统计计算文档得分
func (dsm DocScoreMapping) scoring(docid string, word Word, frequency int){
	score, tag := dsm[Docid(docid)]
	if tag {
		dsm[Docid(docid)] = score + frequency
	}else{
		dsm[Docid(docid)] = frequency
	}
}

func (sl ScoreList) Len() int      { return len(sl) }
func (sl ScoreList) Swap(i, j int) { sl[i], sl[j] = sl[j], sl[i] }
func (sl ScoreList) Less(i, j int) bool { return sl[i].Score > sl[j].Score }
//文档得分排序
func (sl *ScoreList) sort(){
	for docid, score := range docScoreMapping{
		ds := DocScore{Id:docid, Score:score}
		*sl = append(*sl, ds)
	}
	sort.Sort(sl)
	fmt.Println()
	//fmt.Println(sl)
}
