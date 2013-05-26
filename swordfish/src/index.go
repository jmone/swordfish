package main

import(
	"fmt"
	"strconv"
)

type DocWordsMapping struct{
	Docid uint
	Words []string
}
type Index map[string][]string

func  readIndex(){

}

func updateIndex(){

}

func writeIndex(){

}

func main(){
	doc1 := []string{"hello", "test", "okay"}
	doc2 := []string{"hello", "world", "word", "golang"}
	doc3 := DocWordsMapping{Docid:1000, Words:[]string{"hello", "world"}}
	words := []string{}
	for i:=1; i<10; i++{
		words = append(words, "word_"+strconv.Itoa(i))
	}
	doc4 := DocWordsMapping{Docid:119, Words:words}
	//index := map[string][]int{}
	//index["hello"] = []int{1,2}
	//index["test"] = []int{1}
	fmt.Println()
	fmt.Println(doc1)
	fmt.Println(doc2)
	fmt.Println(doc3)
	fmt.Println()
	fmt.Println(doc4)
	index := map[string][]string{}
	index["hello"] = []string{"1","2","3"}
	index["test"] = []string{"5","7", "9"}
	for _, doc2word := range doc2{
		index["test"] = append(index["test"], doc2word)
	}
	fmt.Println(index)
}
