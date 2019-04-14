import unittest
from SVD.SVDCalculator import SVDCalculator
import numpy as np


class TestSVD(unittest.TestCase):
    def test_decomposition(self):
        data = self.___get_sample_data()
        calculator = SVDCalculator()
        calculator.decomposition(data)
        calculator.print_matrices()
        self.assertEqual(True, np.allclose(self.__S(), calculator.get_S()))
        self.assertEqual(True, np.allclose(self.__U(), calculator.get_U()))
        self.assertEqual(True, np.allclose(self.__VH(), calculator.get_VH()))

    def ___get_sample_data(self):
        return np.array([
            [1, 0, 0, 0, 2],
            [0, 0, 3, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 4, 0, 0, 0]
        ])

    def __S(self):
        return np.array([
            4, 3, np.sqrt(5), 0
        ])

    def __U(self):
        return np.array([
            [0, 0, 1, 0],
            [0, 1, 0, 0],
            [0, 0, 0, -1],
            [1, 0, 0, 0]
        ])

    def __VH(self):
        return np.array([
            [0, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [np.sqrt(0.2), 0, 0, 0, np.sqrt(0.8)],
            [0, 0, 0, 1, 0],
            [-1*np.sqrt(0.8), 0, 0, 0, np.sqrt(0.2)]
        ])


if __name__=='__main__':
    unittest.main()
