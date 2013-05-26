package main

import "path/filepath"
import "fmt"
import "sort"
import "os"
import "io"

func main(){
	path := "/home/jmone/dev/godoc_app/index.split.*"
	matches, err := filepath.Glob(path)

	if err == nil{
		sort.Strings(matches)
		fmt.Println(matches)
	}else if matches == nil{
		fmt.Println("Matchs is nil")
	}
        files := make([]io.Reader, 0, len(matches))
        for _, filename := range matches {
		fmt.Println(filename)
                f, err := os.Open(filename)
                if err != nil {
                        fmt.Println(err.Error())
                }
                defer f.Close()
                files = append(files, f)
        }

}
