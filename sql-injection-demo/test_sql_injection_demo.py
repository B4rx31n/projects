import unittest
import sql_injection_demo

class TestSqlInjectionDemo(unittest.TestCase):

    def setUp(self):
        self.conn = sql_injection_demo.create_db()

    def test_vulnerable_login_normal(self):
        # valid credentials
        self.assertTrue(sql_injection_demo.vulnerable_login(self.conn, 'admin', 'admin123'))
        self.assertTrue(sql_injection_demo.vulnerable_login(self.conn, 'user', 'userpass'))
        # invalid credentials
        self.assertFalse(sql_injection_demo.vulnerable_login(self.conn, 'admin', 'wrongpass'))
        self.assertFalse(sql_injection_demo.vulnerable_login(self.conn, 'nonuser', 'nopass'))

    def test_vulnerable_login_sql_injection(self):
        # SQL Injection attempt that bypasses password
        malicious_password = "' OR '1'='1"
        self.assertTrue(sql_injection_demo.vulnerable_login(self.conn, 'admin', malicious_password))
        self.assertTrue(sql_injection_demo.vulnerable_login(self.conn, 'user', malicious_password))

    def test_safe_login_normal(self):
        # valid credentials
        self.assertTrue(sql_injection_demo.safe_login(self.conn, 'admin', 'admin123'))
        self.assertTrue(sql_injection_demo.safe_login(self.conn, 'user', 'userpass'))
        # invalid credentials
        self.assertFalse(sql_injection_demo.safe_login(self.conn, 'admin', 'wrongpass'))
        self.assertFalse(sql_injection_demo.safe_login(self.conn, 'nonuser', 'nopass'))

    def test_safe_login_sql_injection(self):
        # SQL Injection attempts should NOT work here
        malicious_password = "' OR '1'='1"
        self.assertFalse(sql_injection_demo.safe_login(self.conn, 'admin', malicious_password))
        self.assertFalse(sql_injection_demo.safe_login(self.conn, 'user', malicious_password))

if __name__ == '__main__':
    unittest.main()
