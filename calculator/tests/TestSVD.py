import unittest
from SVD.SVDCalculator import SVDCalculator
import numpy as np


class TestSVD(unittest.TestCase):

    def test_decomposition(self):
        data = self.___get_sample_data()
        calculator = SVDCalculator()
        calculator.decomposition(data)
        # calculator.print_matrices()
        self.assertEqual(True, np.allclose(self.__S(), calculator.get_S()))
        self.assertEqual(True, np.allclose(self.__U(), calculator.get_U()))
        self.assertEqual(True, np.allclose(self.__VT(), calculator.get_VT()))

    def test_movies(self):
        data = self.___get_sample_data_movies()
        calculator = SVDCalculator()
        calculator.decomposition(data)
        #
        result = calculator.get_similar_items_ids(2)
        for r in result:
            print(r)
        calculator.print_matrices()

    def ___get_sample_data(self):

        return np.array([
            [1, 0, 0, 0, 2],
            [0, 0, 3, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 4, 0, 0, 0]
        ])

    def __S(self):

        return np.array([
            4, 3, np.sqrt(5)
        ])

    def __U(self):

        return np.array([
            [0, 0, 1],
            [0, 1, 0],
            [0, 0, 0],
            [1, 0, 0]
        ])

    def __VT(self):

        return np.array([
            [0, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [np.sqrt(0.2), 0, 0, 0, np.sqrt(0.8)],
        ])

    def ___get_sample_data_movies(self):

        return np.array([
            [1, 1, 1, 0, 0],
            [3, 3, 3, 0, 0],
            [4, 4, 4, 0, 0],
            [5, 5, 5, 0, 0],
            [0, 2, 0, 4, 4],
            [0, 0, 0, 5, 5],
            [0, 1, 0, 2, 2]
        ])


if __name__ == '__main__':
    unittest.main()
