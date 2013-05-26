package main

import(
	"fmt"
	"bytes"
	"encoding/gob"
	"io/ioutil"
)

type DocWordsMapping struct{
        Docid uint
        Words []string
}

type Index map[string][]string

func main(){
        index := map[string][]string{}
        tmp := map[string][]string{}
        index["hello"] = []string{"1","2","3"}
        index["test"] = []string{"5","7", "9"}
	fmt.Println(index)

	//var w io.Writer
	var w bytes.Buffer
	enc := gob.NewEncoder(&w)
	err := enc.Encode(index)
	if err != nil{
		fmt.Println(err.Error())
	}
	//fmt.Println(string(w.Bytes()))
	err = ioutil.WriteFile("swordfish.index", w.Bytes(), 0644)
	if err != nil {
		fmt.Println(err.Error())
	}

	b,_ := ioutil.ReadFile("swordfish.index")
	x := bytes.NewBuffer(b)
	dec := gob.NewDecoder(x)
	err = dec.Decode(&tmp)
	fmt.Println(tmp)
}
