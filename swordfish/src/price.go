package main

import(
	"fmt"
	"strconv"
	"labix.org/v2/mgo"
	"labix.org/v2/mgo/bson"
)

type DocObjectId struct{
	DocId bson.ObjectId "_id"
	SalePrice string "sale_price"
}
//根据价格筛选结果
func (sl *ScoreList)clear(startPrice, endPrice float64, order string){
	fmt.Println("Price:"+strconv.FormatFloat(startPrice, 'e', 2, 64)+"~"+strconv.FormatFloat(endPrice, 'e', 2, 64))

	session, err := mgo.Dial("127.0.0.1")
	if err != nil{
		fmt.Println("mgo dial fail")
	}
	defer session.Close()
	session.SetMode(mgo.Monotonic, true)
	c := session.DB("swordfish").C("product")

	tmp1 := *sl
	var tmp2 ScoreList
	for _, sd := range tmp1{
		var result DocObjectId
		err = c.Find(bson.M{"_id": bson.ObjectIdHex(string(sd.Id))}).One(&result)
		if err == nil{
			price, _ := strconv.ParseFloat(result.SalePrice, 64)
			sd.Price = price
			if price >= startPrice && price <= endPrice{
				tmp2 = append(tmp2, sd)
			}
		}
	}
	if(order == "desc" || order == "asc"){
		tmp2.orderbyprice(order, len(tmp2))
	}
	*sl = tmp2

	/*
	result := []DocObjectId{}
	//err := c.Find(bson.M{"_id": bson.M{"$gt": lastId}}).All(&result)
	err = c.Find(bson.M{"sale_price": bson.M{"$gte": startPrice}, bson.M{"$lte": endPrice}}).All(&result)
	if err == nil && len(result) > 0{
		fmt.Println(result)
	}
	totalSize := len(*sl)
	size := 200
	totalPage := totalSize/size
	if totalSize%size != 0{
		totalPage += 1
	}

	session, err := mgo.Dial("127.0.0.1")
	if err != nil{
		fmt.Println("mgo dial fail")
	}
	defer session.Close()
	session.SetMode(mgo.Monotonic, true)
	c := session.DB("swordfish").C("product")

	for page := 1; page <= totalPage; page++{
		result := []ObjectId{}
		err = c.Find(bson.M{"_id": bson.M{"$gt": lastId}}).All(&result)
		if err == nil && len(result) > 0{
			fmt.Println(result)
		}
	}
	*/
}

//根据价格排序
func (sl *ScoreList)orderbyprice(order string, size int){
	if(len(*sl) < size){
		size = len(*sl)
	}

	for i := 0; i < size; i++{
		for j := i; j < size; j++{
			if(order == "desc"){
				if((*sl)[i].Price < (*sl)[j].Price){
					(*sl)[i], (*sl)[j]= (*sl)[j], (*sl)[i]
				}
			}else if(order == "asc"){
				if((*sl)[i].Price > (*sl)[j].Price){
					(*sl)[i], (*sl)[j]= (*sl)[j], (*sl)[i]
				}
			}
		}
	}
}
