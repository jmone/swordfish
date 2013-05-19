//swordfish

/*
基于词典的逆向最大匹配中文分词算法
Reverse maximum matching Chinese dictionary-based word segmentation algorithm
*/
package main

import(
	"fmt"
	"io/ioutil"
	"strings"
	//"unicode/utf8"
)

const(
	MaxLenght = 10
	MinLenght = 2
)

type segmentationData struct{
	Text string
	IsFinal bool
}

//文本特殊字符转换及过滤
func filter(text string) string{
	text = strings.TrimSpace(text)
	text = strings.Replace(text, "：", ":", -1);
	text = strings.Replace(text, "；", ";", -1);
	text = strings.Replace(text, "，", ",", -1);
	text = strings.Replace(text, "。", ".", -1);
	text = strings.Replace(text, "？", "?", -1);
	text = strings.Replace(text, "！", "!", -1);
	text = strings.Replace(text, "“", "\"", -1);
	text = strings.Replace(text, "”", "\"", -1);
	text = strings.Replace(text, "‘", "'", -1);
	text = strings.Replace(text, "’", "'", -1);
	text = strings.Replace(text, "（", "(", -1);
	text = strings.Replace(text, "）", ")", -1);
	text = strings.Replace(text, "【", "[", -1);
	text = strings.Replace(text, "】", "]", -1);
	text = strings.Replace(text, "『", "{", -1);
	text = strings.Replace(text, "』", "}", -1);
	text = strings.Replace(text, "《", "<", -1);
	text = strings.Replace(text, "》", ">", -1);
	text = strings.Replace(text, "\a", " ", -1);
	text = strings.Replace(text, "\b", " ", -1);
	text = strings.Replace(text, "\f", " ", -1);
	text = strings.Replace(text, "\n", " ", -1);
	text = strings.Replace(text, "\r", " ", -1);
	text = strings.Replace(text, "\t", " ", -1);
	text = strings.Replace(text, "\v", " ", -1);
	text = strings.Replace(text, "\r\n", " ", -1);
	text = strings.Replace(text, "　", " ", -1);
	return text
}

//标点符号、空格对文本进行切分
func punctuation_seg(text string) []string{
	result := []string{}
	word := ""
	chars := strings.Split(text, "")
	for _, char := range chars{
		if char == " " || char == ":" ||char==";"|| char == "," || char == "."||char=="?"||char=="!"||char=="\""||char=="'"||char=="("||char==")"||char=="["||char=="]"||char=="{"||char=="}"||char=="<"||char==">"{
			if word != ""{
				result = append(result, word)
				word = ""
			}
		}else{
			word += char
		}
		//fmt.Printf("%d:%s:%d\n", i, char, len(char))
	}
	//fmt.Println(result)
	return result
}

func is_single_word_rune(ch rune) bool{
	single := false;
	if( (ch >= '0' && ch <= '9') || (ch >= 'A' && ch <= 'Z') || (ch >= 'a' && ch <= 'z') || ch == '-' || ch == '_' ){
		single = true
	}
	return single
}
//英文单词对文本进行切分
func single_word_seg(text string) []segmentationData{
	result := []segmentationData{}
	word := ""
	tag := 0//0表示是连续的字母或数字，1表示是连续的非字母数字
	for _, ch := range text{
		if is_single_word_rune(ch){
			if tag != 0 && word != ""{
				result = append(result, segmentationData{Text:word, IsFinal:false})
				word = ""
			}
			tag = 0
			word += string(ch)
		}else{
			if tag != 1 && word != ""{
				result = append(result, segmentationData{Text:word, IsFinal:true})
				word = ""
			}
			tag = 1
			word += string(ch)
		}
	}
	if word != ""{
		result = append(result, segmentationData{Text:word, IsFinal:tag==0})
	}
	//fmt.Println(result)
	return result
}


//停止词
func is_stop_word(text string) bool{
	words := map[string]bool{"的":true, "了":true, "在":true, "是":true, "我":true, "有":true, "和":true, "就":true, "不":true, "人":true, "都":true, "一":true, "一个":true, "上":true, "也":true, "很":true, "到":true, "说":true, "要":true, "去":true, "你":true, "会":true, "着":true, "没有":true, "看":true, "好":true, "自己":true, "这":true}
	return words[text]
}

func init_dict(path string) map[string]int{
	input, err := ioutil.ReadFile(path)
	if err != nil{
		fmt.Println(err.Error())
		return nil
	}
	text := string(input)
	text = strings.Replace(text, "null", "", -1)
	text = strings.Replace(text, "\n", "", -1)
	words := strings.Split(text, "/")
	dict := map[string]int{}
	for _, word := range words{
		dict[word] = 1
	}
	return dict
}
func add_new_words(dict map[string]int, words []string) map[string]int{
	for _, word := range words{
		if word != ""{
			dict[word] = 1
		}
	}
	return dict
}

//字典切分
func dict_seg(data []segmentationData) []segmentationData{
	dict := init_dict("main.dict")
	news_words := []string{"谷歌", "触控屏", "新浪", "美国", "麻刚沙", "毛利率"}
	dict = add_new_words(dict, news_words)

	seg_result := []segmentationData{}
	for _, ele := range data{
		if ele.IsFinal{
			seg_result = append(seg_result, ele)
			continue
		}

		result := []segmentationData{}
		arr := strings.Split(ele.Text, "")
		if len(arr) > MaxLenght{
			for i:=len(arr); i>MaxLenght; i--{
				for j:=MaxLenght; j>=MinLenght; j--{
					if word := strings.Join(arr[i-j:i], ""); dict[word] == 1{
						result = append(result, segmentationData{Text:word, IsFinal:true})
						i = i-j+1
						break
					}
					if(j==1){
						word := strings.Join(arr[i-j:i], "")
						result = append(result, segmentationData{Text:word, IsFinal:true})
					}
				}
			}
			for i:=MaxLenght; i>0; i--{
				for j := i; j>=MinLenght; j--{
					if word := strings.Join(arr[i-j:i], ""); dict[word] == 1{
						result = append(result, segmentationData{Text:word, IsFinal:true})
						i = i-j+1
						break
					}
					if(j==1){
						word := strings.Join(arr[i-j:i], "")
						result = append(result, segmentationData{Text:word, IsFinal:true})
					}
				}
			}
		}else{
			for i:=len(arr); i>0; i--{
				for j := i; j>=MinLenght; j--{
					if word := strings.Join(arr[i-j:i], ""); dict[word] == 1{
						result = append(result, segmentationData{Text:word, IsFinal:true})
						i = i-j+1
						break
					}
					if(j==1){
						word := strings.Join(arr[i-j:i], "")
						result = append(result, segmentationData{Text:word, IsFinal:true})
					}
				}
			}

		}
		for i:=len(result)-1; i>=0; i--{
			seg_result = append(seg_result, result[i])
		}
	}
	return seg_result
}



func main(){
	input, err := ioutil.ReadFile("./input.txt")
	if err != nil{
		fmt.Println(err.Error())
		return
	}
	text := string(input)
	text = filter(text)
	fmt.Println("--------------字符过滤------------------------------------------------------------------------------------------------------------------")
	fmt.Println(text)
	//fmt.Println("--------------分词结果------------------------------------------------------------------------------------------------------------------")
	result := single_word_seg(text)
	fmt.Println(result)
	fmt.Println("--------------分词结果------------------------------------------------------------------------------------------------------------------")
	result = dict_seg(result)
	for _, ele := range result{
		fmt.Printf("%s ", ele.Text)
	}
	println()
	/*
	fmt.Println("--------------分词结果------------------------------------------------------------------------------------------------------------------")
	result = []segmentationData{{Text:"建筑行业偷工减料、以次充好的乱象由来已久，最新曝出的一出是山东潍坊用麻刚沙盖楼。", IsFinal:false}, {Text:"小米科技是一家互联网企业", IsFinal:false}}
	fmt.Println(dict_seg(result))
	*/
}
