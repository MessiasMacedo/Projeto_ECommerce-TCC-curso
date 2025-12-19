namespace WinFormsApp3
{
    partial class CadastrarEditarProdutos
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
            lblSKU = new Label();
            lblNome = new Label();
            lblDescricao = new Label();
            textBox1 = new TextBox();
            textBox2 = new TextBox();
            textBox3 = new TextBox();
            lblCategoria = new Label();
            lblSub = new Label();
            comboBox1 = new ComboBox();
            comboBox2 = new ComboBox();
            lblImage = new Label();
            pictureBox1 = new PictureBox();
            btnSelecionar = new Button();
            button2 = new Button();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            SuspendLayout();
            // 
            // lblSKU
            // 
            lblSKU.AutoSize = true;
            lblSKU.Location = new Point(26, 36);
            lblSKU.Name = "lblSKU";
            lblSKU.Size = new Size(36, 20);
            lblSKU.TabIndex = 0;
            lblSKU.Text = "SKU";
            // 
            // lblNome
            // 
            lblNome.AutoSize = true;
            lblNome.Location = new Point(26, 76);
            lblNome.Name = "lblNome";
            lblNome.Size = new Size(50, 20);
            lblNome.TabIndex = 1;
            lblNome.Text = "Nome";
            // 
            // lblDescricao
            // 
            lblDescricao.AutoSize = true;
            lblDescricao.Location = new Point(26, 165);
            lblDescricao.Name = "lblDescricao";
            lblDescricao.Size = new Size(74, 20);
            lblDescricao.TabIndex = 2;
            lblDescricao.Text = "Descrição";
            // 
            // textBox1
            // 
            textBox1.Location = new Point(94, 33);
            textBox1.Name = "textBox1";
            textBox1.Size = new Size(125, 27);
            textBox1.TabIndex = 3;
            // 
            // textBox2
            // 
            textBox2.Location = new Point(94, 69);
            textBox2.Name = "textBox2";
            textBox2.Size = new Size(125, 27);
            textBox2.TabIndex = 4;
            // 
            // textBox3
            // 
            textBox3.Location = new Point(82, 165);
            textBox3.Multiline = true;
            textBox3.Name = "textBox3";
            textBox3.Size = new Size(185, 47);
            textBox3.TabIndex = 5;
            // 
            // lblCategoria
            // 
            lblCategoria.AutoSize = true;
            lblCategoria.Location = new Point(14, 113);
            lblCategoria.Name = "lblCategoria";
            lblCategoria.Size = new Size(74, 20);
            lblCategoria.TabIndex = 6;
            lblCategoria.Text = "Categoria";
            // 
            // lblSub
            // 
            lblSub.AutoSize = true;
            lblSub.Location = new Point(227, 113);
            lblSub.Name = "lblSub";
            lblSub.Size = new Size(99, 20);
            lblSub.TabIndex = 7;
            lblSub.Text = "SubCategoria";
            // 
            // comboBox1
            // 
            comboBox1.FormattingEnabled = true;
            comboBox1.Location = new Point(94, 110);
            comboBox1.Name = "comboBox1";
            comboBox1.Size = new Size(127, 28);
            comboBox1.TabIndex = 8;
            // 
            // comboBox2
            // 
            comboBox2.FormattingEnabled = true;
            comboBox2.Location = new Point(332, 110);
            comboBox2.Name = "comboBox2";
            comboBox2.Size = new Size(127, 28);
            comboBox2.TabIndex = 9;
            // 
            // lblImage
            // 
            lblImage.AutoSize = true;
            lblImage.Location = new Point(142, 254);
            lblImage.Name = "lblImage";
            lblImage.Size = new Size(140, 20);
            lblImage.TabIndex = 10;
            lblImage.Text = "Preview da Imagem";
            // 
            // pictureBox1
            // 
            pictureBox1.Location = new Point(105, 293);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(221, 132);
            pictureBox1.TabIndex = 11;
            pictureBox1.TabStop = false;
            // 
            // btnSelecionar
            // 
            btnSelecionar.Location = new Point(82, 447);
            btnSelecionar.Name = "btnSelecionar";
            btnSelecionar.Size = new Size(94, 29);
            btnSelecionar.TabIndex = 12;
            btnSelecionar.Text = "button1";
            btnSelecionar.UseVisualStyleBackColor = true;
            // 
            // button2
            // 
            button2.Location = new Point(251, 447);
            button2.Name = "button2";
            button2.Size = new Size(94, 29);
            button2.TabIndex = 13;
            button2.Text = "button2";
            button2.UseVisualStyleBackColor = true;
            // 
            // CadastrarEditarProdutos
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            Controls.Add(button2);
            Controls.Add(btnSelecionar);
            Controls.Add(pictureBox1);
            Controls.Add(lblImage);
            Controls.Add(comboBox2);
            Controls.Add(comboBox1);
            Controls.Add(lblSub);
            Controls.Add(lblCategoria);
            Controls.Add(textBox3);
            Controls.Add(textBox2);
            Controls.Add(textBox1);
            Controls.Add(lblDescricao);
            Controls.Add(lblNome);
            Controls.Add(lblSKU);
            Name = "CadastrarEditarProdutos";
            Size = new Size(486, 576);
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label lblSKU;
        private Label lblNome;
        private Label lblDescricao;
        private TextBox textBox1;
        private TextBox textBox2;
        private TextBox textBox3;
        private Label lblCategoria;
        private Label lblSub;
        private ComboBox comboBox1;
        private ComboBox comboBox2;
        private Label lblImage;
        private PictureBox pictureBox1;
        private Button btnSelecionar;
        private Button button2;
    }
}
