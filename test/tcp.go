package main

import(
	"fmt"
	"strings"
	"net"
	_"strconv"
)

func main(){
	ln, err := net.Listen("tcp", ":8080")
	if err != nil {
		// handle error
	}
	defer ln.Close()
	for {
		conn, err := ln.Accept()
		if err != nil {
			// handle error
			fmt.Println(err.Error())
			continue
		}
		index := map[string][]string{}
		index["hello"] = []string{"1","2","3"}
		index["test"] = []string{"5","7", "9"}
		go func(c net.Conn, index map[string][]string){
			//fmt.Println(index)
			for(true){
				buffer := make([]byte, 1024)
				size, err := c.Read(buffer)
				if err != nil{
					fmt.Println(err.Error())
					return
				}
				word := string(buffer[:size])
				word = strings.Replace(word, "\n", "", -1)
				word = strings.Replace(word, "\r", "", -1)
				fmt.Println("accept:"+word)
				//fmt.Println(index[word])
				_, werr := c.Write([]byte("123\n"))
				if werr != nil{
					fmt.Println(werr.Error())
				}else{
					//fmt.Println("send "+strconv.Itoa(wlen))
				}
				//defer conn.Close()
			}
		}(conn, index)
	}
}
