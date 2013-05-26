package main

import "fmt"
type Index map[string][]string

func main(){
	index := make(Index)
	index["hello"] = []string{"123"}
	fmt.Println(index)
}
