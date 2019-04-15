import numpy as np


class SVDCalculator:
    def __init__(self):
        self.no_concepts = 0
        self.U = False
        self.S = False
        self.VT = False
        self.e = 0.00001
        self.data = False
        self.no_products = 0

    def decomposition(self, data):
        self.data = data
        _, self.no_products = data.shape
        self.U, self.S, self.VT = np.linalg.svd(data, full_matrices=True)
        self.no_concepts =sum(self.S > self.e)
        self.S = self.S[0:self.no_concepts]
        self.VT = self.VT[0:self.no_concepts]
        self.U = self.U[:, 0:self.no_concepts]

    def sensivity_to_concepts(self, e):
        self.e = e

    def print_matrices(self):
        print("Num of products: ", self.num_of_products())
        print("Num of concepts: ", self.num_of_concepts())
        print("U")
        print("-----------")
        print(self.get_U())
        print("S")
        print("-----------")
        print(self.get_S())
        print("VT")
        print("-----------")
        print(self.get_VT())
        print("similarities")
        print("-----------")
        print(self.similarities())

    #strength
    def get_S(self):
        return self.S

    def get_U(self):
        return self.U

    def get_VT(self):
        return self.VT

    def num_of_concepts(self):
        return self.no_concepts

    def num_of_products(self):
        return self.no_products

    def similarities(self):
        return np.abs(self.get_VT())

    def get_similar_items(self,index,mask=False,threshold=0.7):
        return self.__get_similar_items(index, lambda v, i:  v, mask, threshold)

    def get_similar_items_ids(self,index,mask=False,threshold=0.7):
        return self.__get_similar_items(index,lambda v, i:  i, mask, threshold)

    def __get_similar_items(self, index,callback, mask=False,threshold=0.7):
        if mask is False:
            mask = np.ones(self.no_concepts) == 1
        item = np.abs(self.VT[mask, index])
        m = np.sqrt(sum(np.power(item,2)))

        for i, item2 in enumerate(self.similarities().T):
            if i == index:
                continue
            selected = item2[mask]
            similarity = sum(np.multiply(item, selected)) / (np.sqrt(sum(np.power(selected,2))) * m)
            if similarity > threshold:
                yield callback(selected,i)