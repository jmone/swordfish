package main
import(
	"fmt"
	"labix.org/v2/mgo"
	"labix.org/v2/mgo/bson"
)
type Person struct {
	ObjectId bson.ObjectId "_id"
	Name string
	Phone string
}
func main() {
	session, err := mgo.Dial("127.0.0.1")
	if err != nil {
		panic(err)
	}
	defer session.Close()
	// Optional. Switch the session to a monotonic behavior. 
	session.SetMode(mgo.Monotonic, true)
	c := session.DB("test").C("people")
	err = c.Insert(&Person{bson.NewObjectId(), "Ale", "+55 53 8116 9639"}, &Person{bson.NewObjectId(), "Cla", "+55 53 8402 8510"})
	if err != nil {
		panic(err)
	}
	result := Person{}
	err = c.Find(bson.M{"name": "Ale"}).One(&result)
	if err != nil {
		panic(err)
	}
	fmt.Println("Phone:", result.Phone)
	fmt.Println("ObjectId:", result.ObjectId)
}
