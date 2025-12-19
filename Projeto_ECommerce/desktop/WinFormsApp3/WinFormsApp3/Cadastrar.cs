using MySql.Data.MySqlClient;
using ProjetoEcommerce;
using System;
using System.Data;
using System.Drawing;
using System.IO;
using System.Windows.Forms;

namespace WinFormsApp3
{
    public partial class Cadastrar : Form
    {
        public int? ProdutoId = null;

        private string imagemAtual = null;        // nome da imagem (ex: gpu.jpg)
        private string caminhoImagemSite = null;  // caminho para exibir no site

        public Cadastrar()
        {
            InitializeComponent();
        }

        // ===========================================================
        //  LOAD DO FORM
        // ===========================================================
        private void FrmProdutoCadastro_Load(object sender, EventArgs e)
        {
            CarregarCategorias();
            CarregarSubcategorias();

            if (ProdutoId != null)
                CarregarProduto();
        }

        // ===========================================================
        //  CARREGAR CATEGORIAS
        // ===========================================================
        private void CarregarCategorias()
        {
            using (var con = Conexao.GetConnection())
            {
                con.Open();
                var cmd = new MySqlCommand("SELECT id, nome FROM categoria", con);

                DataTable dt = new DataTable();
                dt.Load(cmd.ExecuteReader());

                cmbCat.DataSource = dt;
                cmbCat.DisplayMember = "nome";
                cmbCat.ValueMember = "id";
            }
        }

        // ===========================================================
        //  CARREGAR SUBCATEGORIAS
        // ===========================================================
        private void CarregarSubcategorias()
        {
            using (var con = Conexao.GetConnection())
            {
                con.Open();
                var cmd = new MySqlCommand("SELECT id, nome FROM subcategoria", con);

                DataTable dt = new DataTable();
                dt.Load(cmd.ExecuteReader());

                cmbSub.DataSource = dt;
                cmbSub.DisplayMember = "nome";
                cmbSub.ValueMember = "id";
            }
        }

        // ===========================================================
        //  CARREGAR PRODUTO PARA EDIÇÃO
        // ===========================================================
        private void CarregarProduto()
        {
            using (var con = Conexao.GetConnection())
            {
                con.Open();
                var cmd = new MySqlCommand("SELECT * FROM produto WHERE id=@id", con);
                cmd.Parameters.AddWithValue("@id", ProdutoId);

                var dr = cmd.ExecuteReader();

                if (dr.Read())
                {
                    txbSKU.Text = dr["sku"].ToString();
                    txbNome.Text = dr["nome"].ToString();
                    txbDesc.Text = dr["descricao"].ToString();
                    txbPreco.Text = dr["preco"].ToString();

                    cmbCat.SelectedValue = Convert.ToInt32(dr["categoria_id"]);
                    cmbSub.SelectedValue = Convert.ToInt32(dr["id_subcategoria"]);

                    imagemAtual = dr["img"].ToString();   // nome do arquivo

                    // Carrega a imagem se existir no XAMPP
                    string caminho = "/Projeto_ECommerce/web/public/img/" + imagemAtual;

                    if (File.Exists(caminho))
                        picImagem.Image = Image.FromFile(caminho);
                }
            }
        }

        // ===========================================================
        //  SELECIONAR IMAGEM
        // ===========================================================
        private void btnSelecionarImagem_Click(object sender, EventArgs e)
        {
            OpenFileDialog ofd = new OpenFileDialog();
            ofd.Filter = "Imagens (*.jpg; *.jpeg; *.png)|*.jpg; *.jpeg; *.png";

            if (ofd.ShowDialog() == DialogResult.OK)
            {
                // Caminho original da imagem
                string caminhoOrigem = ofd.FileName;

                // Mostra a imagem no PictureBox (somente visualização)
                picImagem.Image = Image.FromFile(caminhoOrigem);

                // Pasta do XAMPP onde as imagens ficam
                string pastaDestino = @"C:\xampp\htdocs\Projeto_ECommerce\web\public\img";

                // Nome ORIGINAL da imagem
                string nomeArquivo = Path.GetFileName(caminhoOrigem);

                // Caminho final
                string caminhoDestino = Path.Combine(pastaDestino, nomeArquivo);

                // Se já existir → gera um novo nome sem sobrescrever nada
                int contador = 1;
                string nomeSemExt = Path.GetFileNameWithoutExtension(nomeArquivo);
                string extensao = Path.GetExtension(nomeArquivo);

                while (File.Exists(caminhoDestino))
                {
                    nomeArquivo = $"{nomeSemExt}_{contador}{extensao}";
                    caminhoDestino = Path.Combine(pastaDestino, nomeArquivo);
                    contador++;
                }

                // Copia a imagem para o servidor local
                File.Copy(caminhoOrigem, caminhoDestino);

                // 🔥 Salva NO BANCO exatamente o caminho que o site precisa
                imagemAtual = nomeArquivo; // só o nome
                txtImg.Text = "/Projeto_ECommerce/web/public/img/" + nomeArquivo;

                MessageBox.Show("Imagem carregada e copiada com sucesso!");
            }
        }


        // ===========================================================
        //  SALVAR PRODUTO
        // ===========================================================
       private void btnSalvar_Click(object sender, EventArgs e)
{
    if (string.IsNullOrWhiteSpace(txbNome.Text))
    {
        MessageBox.Show("O nome é obrigatório!");
        return;
    }

    if (!decimal.TryParse(txbPreco.Text, out decimal preco))
    {
        MessageBox.Show("Preço inválido!");
        return;
    }

    using (var con = Conexao.GetConnection())
    {
        con.Open();

        string sql =
            ProdutoId == null ?
            @"INSERT INTO produto
            (sku, nome, descricao, preco, categoria_id, id_subcategoria, img)
            VALUES (@sku, @nome, @desc, @preco, @cat, @sub, @img)"
            :
            @"UPDATE produto SET
            sku=@sku, nome=@nome, descricao=@desc, preco=@preco,
            categoria_id=@cat, id_subcategoria=@sub, img=@img
            WHERE id=@id";

        var cmd = new MySqlCommand(sql, con);

        cmd.Parameters.AddWithValue("@sku", txbSKU.Text);
        cmd.Parameters.AddWithValue("@nome", txbNome.Text);
        cmd.Parameters.AddWithValue("@desc", txbDesc.Text);
        cmd.Parameters.AddWithValue("@preco", preco);
        cmd.Parameters.AddWithValue("@cat", cmbCat.SelectedValue);
        cmd.Parameters.AddWithValue("@sub", cmbSub.SelectedValue);

        // 🔥 Aqui vai exatamente o caminho final usado no site
        cmd.Parameters.AddWithValue("@img", txtImg.Text);

        if (ProdutoId != null)
            cmd.Parameters.AddWithValue("@id", ProdutoId);

        cmd.ExecuteNonQuery();
    }

    MessageBox.Show("Produto salvo com sucesso!");
    this.Close();
}

    }
}
