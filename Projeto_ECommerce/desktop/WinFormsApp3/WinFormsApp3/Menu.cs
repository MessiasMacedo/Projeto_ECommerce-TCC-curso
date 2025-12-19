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
    public partial class Menu : Form
    {
        public Menu()
        {
            InitializeComponent();
        }

        public void AbrirFormularioNoPainel(Form frm)
        {
            panelConteudo.Controls.Clear();   // limpa o painel da direita
            frm.TopLevel = false;             // permite que o form fique dentro do painel
            frm.FormBorderStyle = FormBorderStyle.None; // remove bordas
            frm.Dock = DockStyle.Fill;        // ocupa o painel inteiro
            panelConteudo.Controls.Add(frm);  // adiciona no painel
            frm.Show();
        }


        private void AbrirPagina(UserControl uc)
        {
            panelConteudo.Controls.Clear();
            uc.Dock = DockStyle.Fill;
            panelConteudo.Controls.Add(uc);
            uc.BringToFront();
        }


        private void btnProdutos_Click(object sender, EventArgs e)
        {
            AbrirPagina(new UCProdutos());
        }

        private void btnEstoque_Click(object sender, EventArgs e)
        {
            AbrirPagina(new UCEstoque());
        }

        private void btnUsuários_Click(object sender, EventArgs e)
        {

        }

        private void btnSair_Click(object sender, EventArgs e)
        {

        }

        private void btnCadEditProd_Click(object sender, EventArgs e)
        {
            Cadastrar frm = new Cadastrar();  // seu form
            AbrirFormularioNoPainel(frm);
        }
    }
}
