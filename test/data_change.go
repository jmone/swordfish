package main

import(
	"fmt"
	"labix.org/v2/mgo"
	"labix.org/v2/mgo/bson"
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
)

var(
	c *mgo.Collection
	db *sql.DB
)

func init(){
	session, err := mgo.Dial("127.0.0.1")
	if err != nil{
		panic(err)
	}
	//defer session.Close()

	session.SetMode(mgo.Monotonic, true)
	c = session.DB("swordfish").C("product")

	db, err = sql.Open("mysql", "root:32100321@/swordfish")
	if err != nil{
		panic(err)
	}
	//defer db.Close()
}

type Product struct{
	//DocId bson.ObjectId "_id"
	ShopId int32 "shop_id"
	Title string "title"
	SalePrice string "sale_price"
	OriginalPrice string "original_price"
	Url string "url"
	UpdateTime int64 "update_time"
	Image string "image"
	Reindex bool "reindex"
}

func getCount() int{
	count, err := c.Count()
	if err != nil{
		panic(err)
	}
	return count
}

func getMongoData(page int, size int) []Product{
	result := []Product{}
	err := c.Find(bson.M{}).Limit(size).Skip((page-1)*size).All(&result)
	if err != nil{
		panic(err)
	}
	return result
}

func saveDataToMysql(data Product){
	stmtIns, err := db.Prepare("INSERT INTO `swordfish`.`product` (`id` ,`shop_id` ,`title` ,`sale_price` ,`original_price` ,`url` ,`update_time` ,`image` ,`reindex`) VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?);")
	if err != nil{
		panic(err)
	}

	_, err = stmtIns.Exec(data.ShopId, data.Title, data.SalePrice, data.OriginalPrice, data.Url, data.UpdateTime, data.Image, data.Reindex)
	if err != nil{
		panic(err)
	}
}

func main(){
	count := getCount()
	size := 1000

	//get total page number.
	totalPageNumber := count/size
	if count%size != 0{
		totalPageNumber += 1
	}

	for page := 1; page <= totalPageNumber; page++{
		fmt.Println(page, size)
		products := getMongoData(1, size)

		for _, p := range products{
			saveDataToMysql(p)
		}
	}
}
