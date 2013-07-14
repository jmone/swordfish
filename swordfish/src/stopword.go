//停止词

package main

import(
        "database/sql"
        "fmt"
        _ "github.com/go-sql-driver/mysql"
	"os"
	"strconv"
	"time"
)

type Stopword string
type Dbstopword struct{
	Id int
	Word string
}
//停止词库结构
//Updatetime 表示当前Words中关键词的更新时间，实时与stopword_updatetime.txt中的更新时间进行比较，小的话则从数据库中load最新的
type Stopwords struct{
	Updatetime uint
	Words map[string]bool
}

//初始化
func (stopwords *Stopwords) init(){
        db, err := sql.Open("mysql", "root:32100321@/swordfish")
        if err != nil {
                panic(err.Error())  // Just for example purpose. You should use proper error handling instead of panic
        }
        defer db.Close()

	// Execute the query
	rows, err := db.Query("SELECT word FROM stop_word")
	if err != nil {
		panic(err.Error()) // proper error handling instead of panic in your app
	}

	// Fetch rows
	for rows.Next() {
		var word string
		// get RawBytes from data
		err = rows.Scan(&word)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		stopwords.Words[word] = true
	}
}

//更新停止词库
//如果stopword_updatetime.txt存在，则比较词库与txt中的更新时间
func (stopwords *Stopwords) update(){
	for{
		time.Sleep(60 * 1e9)

		in, err := os.Open("./stopword_updatetime.txt")
		defer in.Close()
		if err != nil{
			fmt.Println(err.Error())
		}

		buf := make([]byte, 1024)
		n, _ := in.Read(buf)
		updatetime, _ := strconv.Atoi(string(buf[:n]))
		fmt.Println(updatetime)
		if(uint(updatetime) > stopwords.Updatetime){
			stopwords.init()
		}
	}
}

//是否为停止词
func (words Stopwords) IsStopword(word string) bool{
	return words.Words[word]
}

/*
func main(){
	var stopwords Stopwords
	stopwords.Words = make(map[string] bool)
	stopwords.init()
	stopwords.Words["c"] = false
	fmt.Println(stopwords)
	go stopwords.update()
	time.Sleep(1 * 1e9)
	fmt.Println(stopwords.IsStopword("c"))
	fmt.Println(stopwords.IsStopword("与"))
}
*/
