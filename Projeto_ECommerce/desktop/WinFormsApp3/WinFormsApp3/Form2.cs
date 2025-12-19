using MySql.Data.MySqlClient;
using ProjetoEcommerce;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WinFormsApp3
{
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }

        private void btnCadastrar_Click(object sender, EventArgs e)
        {
            string usuario = txbUsuario.Text.Trim();
            string senha = txbSenha.Text.Trim();
            string confirmar = txbConfirmar.Text.Trim();

            // Validações
            if (usuario == "" || senha == "" || confirmar == "")
            {
                MessageBox.Show("Preencha todos os campos!", "Aviso",
                    MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            if (senha != confirmar)
            {
                MessageBox.Show("As senhas não coincidem!", "Erro",
                    MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            // Gerar hash SHA-256
            string senhaHash = Seguranca.GerarHash(senha);

            try
            {
                using (MySqlConnection con = Conexao.GetConnection())
                {
                    con.Open();

                    string sql = @"INSERT INTO usuarios (email, senha)
                                   VALUES (@usuario, @senha)";

                    MySqlCommand cmd = new MySqlCommand(sql, con);
                    cmd.Parameters.AddWithValue("@usuario", usuario);
                    cmd.Parameters.AddWithValue("@senha", senhaHash);

                    cmd.ExecuteNonQuery();

                    MessageBox.Show("Usuário registrado com sucesso!",
                        "Sucesso", MessageBoxButtons.OK, MessageBoxIcon.Information);

                    this.Close();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro ao registrar usuário:\n" + ex.Message,
                    "Erro", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        private void chbExibir_CheckedChanged(object sender, EventArgs e)
        {
            if (chbExibir.Checked)
            {
                txbSenha.UseSystemPasswordChar = false; // Mostra senha
                txbConfirmar.UseSystemPasswordChar = false; // Mostra senha
            }
            else
            {
                txbSenha.UseSystemPasswordChar = true;  // Oculta senha
                txbConfirmar.UseSystemPasswordChar = true; // Oculta senha
            }
        }
    }

}
