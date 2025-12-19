using MySql.Data.MySqlClient;
using ProjetoEcommerce;
namespace WinFormsApp3
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btnEntrar_Click(object sender, EventArgs e)
        {
            // Testa a conexão antes de tudo
            if (!Conexao.TestarConexao(out string erro))
            {
                MessageBox.Show("Não foi possível conectar ao banco:\n" + erro,
                    "Erro de Conexão", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            string email = txbUsuario.Text;
            string senhaDigitada = txbSenha.Text;

            // GERAR HASH da senha digitada
            string senhaHash = Seguranca.GerarHash(senhaDigitada);


            using (MySqlConnection con = Conexao.GetConnection())
            {
                con.Open();

                MessageBox.Show("Email digitado: [" + email + "]");
                MessageBox.Show(Seguranca.GerarHash("123"));

                string sql = "SELECT * FROM usuarios WHERE email=@u AND senha=@s";

                MySqlCommand cmd = new MySqlCommand(sql, con);
                cmd.Parameters.AddWithValue("@u", email);
                cmd.Parameters.AddWithValue("@s", senhaHash);

                MySqlDataReader dr = cmd.ExecuteReader();

                if (dr.HasRows)
                {
                    MessageBox.Show("Login realizado com sucesso!");

                    Menu menu = new Menu();
                    this.Hide();
                    menu.FormClosed += (s, args) => this.Close();
                    menu.Show();
                }
                else
                {
                    MessageBox.Show("E-mail ou senha incorretos!", "Erro",
                        MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }
        }

        private void chbExibir_CheckedChanged(object sender, EventArgs e)
        {
            if (chbExibir.Checked)
            {
                txbSenha.UseSystemPasswordChar = false; // Mostra senha
            }
            else
            {
                txbSenha.UseSystemPasswordChar = true;  // Oculta senha
            }
        }

        private void btnCadastar_Click(object sender, EventArgs e)
        {
            Form2 cad = new Form2();
            cad.ShowDialog();
        }
    }
}
