import numpy as np


class SVDCalculator:
    def __init__(self):
        self.U = False
        self.S = False
        self.VH = False

    def decomposition(self, data):
        self.U, self.S, self.VH = np.linalg.svd(data, full_matrices=True)

    def print_matrices(self):
        print("U")
        print("-----------")
        print(self.U)
        print("S")
        print("-----------")
        print(self.S)
        print("VH")
        print("-----------")
        print(self.VH)

    def get_S(self):
        return self.S

    def get_U(self):
        return self.U

    def get_VH(self):
        return self.VH
