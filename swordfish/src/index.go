package main

import(
	"fmt"
)

func main(){
	doc1 := []string{"hello", "test", "okay"}
	doc2 := []string{"hello", "world", "word", "golang"}
	index := map[string][]uint{}
	index["hello"] = []int{1,2}
	index["test"] = []int{1}
	fmt.Println()
	fmt.Println(doc1)
	fmt.Println(doc2)
	fmt.Println(index)
}
