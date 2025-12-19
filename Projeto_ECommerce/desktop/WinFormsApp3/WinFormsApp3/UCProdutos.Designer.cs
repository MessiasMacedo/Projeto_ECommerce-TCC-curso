namespace WinFormsApp3
{
    partial class UCProdutos
    {
        /// <summary> 
        /// Variável de designer necessária.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary> 
        /// Limpar os recursos que estão sendo usados.
        /// </summary>
        /// <param name="disposing">true se for necessário descartar os recursos gerenciados; caso contrário, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Código gerado pelo Designer de Componentes

        /// <summary> 
        /// Método necessário para suporte ao Designer - não modifique 
        /// o conteúdo deste método com o editor de código.
        /// </summary>
        private void InitializeComponent()
        {
            dtvProdutos = new DataGridView();
            Id = new DataGridViewTextBoxColumn();
            Nome = new DataGridViewTextBoxColumn();
            Categoria = new DataGridViewTextBoxColumn();
            SubCategoria = new DataGridViewTextBoxColumn();
            Editar = new DataGridViewButtonColumn();
            Excluir = new DataGridViewButtonColumn();
            btnAdicionar = new Button();
            ((System.ComponentModel.ISupportInitialize)dtvProdutos).BeginInit();
            SuspendLayout();
            // 
            // dtvProdutos
            // 
            dtvProdutos.AllowUserToOrderColumns = true;
            dtvProdutos.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dtvProdutos.Columns.AddRange(new DataGridViewColumn[] { Id, Nome, Categoria, SubCategoria, Editar, Excluir });
            dtvProdutos.Location = new Point(18, 153);
            dtvProdutos.Name = "dtvProdutos";
            dtvProdutos.RowHeadersWidth = 51;
            dtvProdutos.Size = new Size(791, 367);
            dtvProdutos.TabIndex = 0;
            dtvProdutos.CellClick += dtvProdutos_CellClick;
            // 
            // Id
            // 
            Id.HeaderText = "ID";
            Id.MinimumWidth = 6;
            Id.Name = "Id";
            Id.Width = 125;
            // 
            // Nome
            // 
            Nome.HeaderText = "Nome";
            Nome.MinimumWidth = 6;
            Nome.Name = "Nome";
            Nome.Width = 125;
            // 
            // Categoria
            // 
            Categoria.HeaderText = "Categoria";
            Categoria.MinimumWidth = 6;
            Categoria.Name = "Categoria";
            Categoria.Width = 125;
            // 
            // SubCategoria
            // 
            SubCategoria.HeaderText = "SubCategoria";
            SubCategoria.MinimumWidth = 6;
            SubCategoria.Name = "SubCategoria";
            SubCategoria.Width = 125;
            // 
            // Editar
            // 
            Editar.HeaderText = "Editar";
            Editar.MinimumWidth = 6;
            Editar.Name = "Editar";
            Editar.Width = 125;
            // 
            // Excluir
            // 
            Excluir.HeaderText = "Excluir";
            Excluir.MinimumWidth = 6;
            Excluir.Name = "Excluir";
            Excluir.Resizable = DataGridViewTriState.True;
            Excluir.SortMode = DataGridViewColumnSortMode.Automatic;
            Excluir.Width = 125;
            // 
            // btnAdicionar
            // 
            btnAdicionar.Location = new Point(18, 118);
            btnAdicionar.Name = "btnAdicionar";
            btnAdicionar.Size = new Size(180, 29);
            btnAdicionar.TabIndex = 1;
            btnAdicionar.Text = "Adicionar Produtos";
            btnAdicionar.UseVisualStyleBackColor = true;
            btnAdicionar.Click += btnAdicionar_Click;
            // 
            // UCProdutos
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            Controls.Add(btnAdicionar);
            Controls.Add(dtvProdutos);
            Name = "UCProdutos";
            Size = new Size(822, 520);
            Load += UCProdutos_Load;
            ((System.ComponentModel.ISupportInitialize)dtvProdutos).EndInit();
            ResumeLayout(false);
        }

        #endregion

        private DataGridView dtvProdutos;
        private DataGridViewTextBoxColumn Id;
        private DataGridViewTextBoxColumn Nome;
        private DataGridViewTextBoxColumn Categoria;
        private DataGridViewTextBoxColumn SubCategoria;
        private DataGridViewButtonColumn Editar;
        private DataGridViewButtonColumn Excluir;
        private Button btnAdicionar;
    }
}
