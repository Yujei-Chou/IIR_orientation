# Recommender system practice
### LeaveOneOut
- 從training set中不同的userId都抽出一筆資料
- 把抽出的資料當作testing set
- 使用surprise.model.selection的LeaveOneOut切割資料

### Top-N Hit Rate
- 針對每個userId將training set的99筆資料與testing set的1筆資料丟進模型預測
- 預測前N個最大的rating值
- 若testing set中的那筆資料有排在前N筆則Hit
- Hit值算法=(所有userId Hit總數)/(user總數)
