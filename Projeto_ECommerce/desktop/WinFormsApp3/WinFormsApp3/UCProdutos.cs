using MySql.Data.MySqlClient;
using ProjetoEcommerce;
using System;
using System.Windows.Forms;

namespace WinFormsApp3
{
    public partial class UCProdutos : UserControl
    {
        public UCProdutos()
        {
            InitializeComponent();
        }

        private void UCProdutos_Load(object sender, EventArgs e)
        {
            ConfigurarGrid();
            CarregarProdutos();
        }

        // CONFIGURA AS COLUNAS DO GRID
        private void ConfigurarGrid()
        {
            dtvProdutos.Columns.Clear();
            dtvProdutos.AllowUserToAddRows = false;
            dtvProdutos.RowTemplate.Height = 40;
            dtvProdutos.AutoGenerateColumns = false;

            // ID (OCULTO)
            var colId = new DataGridViewTextBoxColumn();
            colId.HeaderText = "ID";
            colId.Name = "id";
            colId.Visible = false;
            dtvProdutos.Columns.Add(colId);

            // Nome
            var colNome = new DataGridViewTextBoxColumn();
            colNome.HeaderText = "Nome";
            colNome.Name = "nome";
            dtvProdutos.Columns.Add(colNome);

            // Preço
            var colPreco = new DataGridViewTextBoxColumn();
            colPreco.HeaderText = "Preço";
            colPreco.Name = "preco";
            dtvProdutos.Columns.Add(colPreco);

            // Categoria
            var colCategoria = new DataGridViewTextBoxColumn();
            colCategoria.HeaderText = "Categoria";
            colCategoria.Name = "categoria";
            dtvProdutos.Columns.Add(colCategoria);

            // Botão Editar
            var colEditar = new DataGridViewButtonColumn();
            colEditar.HeaderText = "Editar";
            colEditar.Name = "colEditar";
            colEditar.Text = "Editar";
            colEditar.UseColumnTextForButtonValue = true;
            dtvProdutos.Columns.Add(colEditar);

            // Botão Excluir
            var colExcluir = new DataGridViewButtonColumn();
            colExcluir.HeaderText = "Excluir";
            colExcluir.Name = "colExcluir";
            colExcluir.Text = "Excluir";
            colExcluir.UseColumnTextForButtonValue = true;
            dtvProdutos.Columns.Add(colExcluir);
        }

        // CARREGA PRODUTOS DO BANCO
        private void CarregarProdutos()
        {
            dtvProdutos.Rows.Clear();

            using (var con = Conexao.GetConnection())
            {
                con.Open();

                string sql = @"
                    SELECT p.id, p.nome, p.preco, c.nome AS categoria
                    FROM produto p
                    LEFT JOIN categoria c ON c.id = p.categoria_id";

                var cmd = new MySqlCommand(sql, con);
                var dr = cmd.ExecuteReader();

                while (dr.Read())
                {
                    dtvProdutos.Rows.Add(
                        dr["id"],                         // id (oculto)
                        dr["nome"].ToString(),            // nome
                        dr["preco"].ToString(),           // preco
                        dr["categoria"].ToString(),       // categoria
                        "Editar",
                        "Excluir"
                    );
                }
            }
        }

        // CLIQUE EM EDITAR / EXCLUIR
        private void dtvProdutos_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex < 0 || e.ColumnIndex < 0) return;

            // garante que temos ID
            object idObj = dtvProdutos.Rows[e.RowIndex].Cells["id"].Value;
            if (idObj == null || idObj == DBNull.Value)
                return;

            int idProduto = Convert.ToInt32(idObj);

            string colName = dtvProdutos.Columns[e.ColumnIndex].Name;

            // EDITAR
            if (colName == "colEditar")
            {
                try
                {
                    var frm = new Cadastrar();
                    frm.ProdutoId = idProduto;

                    // se estiver dentro do Menu, abre no painel
                    if (this.ParentForm is Menu menu)
                        menu.AbrirFormularioNoPainel(frm);
                    else
                        frm.ShowDialog(); // fallback
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao abrir tela de edição: " + ex.Message);
                }
            }

            // EXCLUIR
            if (colName == "colExcluir")
            {
                if (MessageBox.Show("Deseja excluir este produto?", "Confirmação",
                    MessageBoxButtons.YesNo, MessageBoxIcon.Warning) == DialogResult.Yes)
                {
                    try
                    {
                        using (var con = Conexao.GetConnection())
                        {
                            con.Open();
                            var cmd = new MySqlCommand("DELETE FROM produto WHERE id=@id", con);
                            cmd.Parameters.AddWithValue("@id", idProduto);
                            cmd.ExecuteNonQuery();
                        }

                        CarregarProdutos();
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("Erro ao excluir produto: " + ex.Message);
                    }
                }
            }
        }

        private void btnAdicionar_Click(object sender, EventArgs e)
        {
            try
            {
                var frm = new Cadastrar();

                if (this.ParentForm is Menu menu)
                    menu.AbrirFormularioNoPainel(frm);
                else
                    frm.ShowDialog();
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro ao abrir tela de cadastro: " + ex.Message);
            }
        }
    }
}
