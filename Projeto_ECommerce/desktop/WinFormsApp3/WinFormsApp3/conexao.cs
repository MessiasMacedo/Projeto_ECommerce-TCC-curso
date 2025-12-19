using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;
using System;

namespace ProjetoEcommerce
{
    public static class Conexao
    {
        private static string connString =
            "Server=127.0.0.1;Database=projeto;Uid=root;Pwd=;";

        // MÉTODO QUE TESTA A CONEXÃO
        public static bool TestarConexao(out string erro)
        {
            erro = "";

            try
            {
                using (MySqlConnection con = new MySqlConnection(connString))
                {
                    con.Open();
                }

                return true;
            }
            catch (Exception ex)
            {
                erro = ex.Message;
                return false;
            }
        }

        // MÉTODO PARA PEGAR A CONEXÃO
        public static MySqlConnection GetConnection()
        {
            return new MySqlConnection(connString);
        }
    }
}

