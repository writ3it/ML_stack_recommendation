import numpy as np


class SVDCalculator:
    def __init__(self):
        self.no_concepts = 0
        self.U = False
        self.S = False
        self.VT = False
        self.e = 0.00001

    def decomposition(self, data):
        self.U, self.S, self.VT = np.linalg.svd(data, full_matrices=True)
        self.no_concepts =sum(self.S > self.e)

    def sensivity_to_concepts(self, e):
        self.e = e

    def print_matrices(self):
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

    #strength
    def get_S(self):
        return self.S[0:self.no_concepts]

    def get_U(self):
        return self.U

    def get_VT(self):
        return self.VT[0:self.no_concepts]

    def num_of_concepts(self):
        return self.no_concepts
