namespace WinFormsApp3
{
    partial class Cadastrar
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
            cmbCat = new ComboBox();
            cmbSub = new ComboBox();
            txbSKU = new TextBox();
            txbNome = new TextBox();
            txbDesc = new TextBox();
            txbPreco = new TextBox();
            picImagem = new PictureBox();
            label1 = new Label();
            label2 = new Label();
            label3 = new Label();
            label4 = new Label();
            label5 = new Label();
            label6 = new Label();
            label7 = new Label();
            button1 = new Button();
            button2 = new Button();
            txtImg = new TextBox();
            ((System.ComponentModel.ISupportInitialize)picImagem).BeginInit();
            SuspendLayout();
            // 
            // cmbCat
            // 
            cmbCat.FormattingEnabled = true;
            cmbCat.Location = new Point(95, 123);
            cmbCat.Name = "cmbCat";
            cmbCat.Size = new Size(151, 28);
            cmbCat.TabIndex = 0;
            // 
            // cmbSub
            // 
            cmbSub.FormattingEnabled = true;
            cmbSub.Location = new Point(120, 168);
            cmbSub.Name = "cmbSub";
            cmbSub.Size = new Size(85, 28);
            cmbSub.TabIndex = 1;
            // 
            // txbSKU
            // 
            txbSKU.Location = new Point(80, 31);
            txbSKU.Name = "txbSKU";
            txbSKU.Size = new Size(125, 27);
            txbSKU.TabIndex = 2;
            // 
            // txbNome
            // 
            txbNome.Location = new Point(80, 80);
            txbNome.Name = "txbNome";
            txbNome.Size = new Size(125, 27);
            txbNome.TabIndex = 3;
            // 
            // txbDesc
            // 
            txbDesc.Location = new Point(32, 283);
            txbDesc.Multiline = true;
            txbDesc.Name = "txbDesc";
            txbDesc.Size = new Size(230, 77);
            txbDesc.TabIndex = 4;
            // 
            // txbPreco
            // 
            txbPreco.Location = new Point(80, 211);
            txbPreco.Name = "txbPreco";
            txbPreco.Size = new Size(125, 27);
            txbPreco.TabIndex = 5;
            // 
            // picImagem
            // 
            picImagem.BackgroundImageLayout = ImageLayout.Stretch;
            picImagem.Location = new Point(287, 31);
            picImagem.Name = "picImagem";
            picImagem.Size = new Size(265, 177);
            picImagem.TabIndex = 6;
            picImagem.TabStop = false;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Location = new Point(12, 38);
            label1.Name = "label1";
            label1.Size = new Size(39, 20);
            label1.TabIndex = 7;
            label1.Text = "SKU:";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Location = new Point(12, 87);
            label2.Name = "label2";
            label2.Size = new Size(53, 20);
            label2.TabIndex = 8;
            label2.Text = "Nome:";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Location = new Point(12, 126);
            label3.Name = "label3";
            label3.Size = new Size(77, 20);
            label3.TabIndex = 9;
            label3.Text = "Categoria:";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Location = new Point(12, 171);
            label4.Name = "label4";
            label4.Size = new Size(102, 20);
            label4.TabIndex = 10;
            label4.Text = "SubCategoria:";
            // 
            // label5
            // 
            label5.AutoSize = true;
            label5.Location = new Point(12, 218);
            label5.Name = "label5";
            label5.Size = new Size(49, 20);
            label5.TabIndex = 11;
            label5.Text = "Preço:";
            // 
            // label6
            // 
            label6.AutoSize = true;
            label6.Location = new Point(12, 249);
            label6.Name = "label6";
            label6.Size = new Size(74, 20);
            label6.TabIndex = 12;
            label6.Text = "Descrição";
            // 
            // label7
            // 
            label7.AutoSize = true;
            label7.Location = new Point(356, 8);
            label7.Name = "label7";
            label7.Size = new Size(143, 20);
            label7.TabIndex = 13;
            label7.Text = "Imagem do Produto";
            // 
            // button1
            // 
            button1.Location = new Point(274, 244);
            button1.Name = "button1";
            button1.Size = new Size(153, 32);
            button1.TabIndex = 14;
            button1.Text = "Selecionar Imagem";
            button1.UseVisualStyleBackColor = true;
            button1.Click += btnSelecionarImagem_Click;
            // 
            // button2
            // 
            button2.Location = new Point(433, 243);
            button2.Name = "button2";
            button2.Size = new Size(128, 32);
            button2.TabIndex = 15;
            button2.Text = "Salvar Produto";
            button2.UseVisualStyleBackColor = true;
            button2.Click += btnSalvar_Click;
            // 
            // txtImg
            // 
            txtImg.Location = new Point(287, 214);
            txtImg.Name = "txtImg";
            txtImg.Size = new Size(125, 27);
            txtImg.TabIndex = 16;
            // 
            // Cadastrar
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(573, 384);
            Controls.Add(txtImg);
            Controls.Add(button2);
            Controls.Add(button1);
            Controls.Add(label7);
            Controls.Add(label6);
            Controls.Add(label5);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label1);
            Controls.Add(picImagem);
            Controls.Add(txbPreco);
            Controls.Add(txbDesc);
            Controls.Add(txbNome);
            Controls.Add(txbSKU);
            Controls.Add(cmbSub);
            Controls.Add(cmbCat);
            Name = "Cadastrar";
            Load += FrmProdutoCadastro_Load;
            ((System.ComponentModel.ISupportInitialize)picImagem).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private ComboBox cmbCat;
        private ComboBox cmbSub;
        private TextBox txbSKU;
        private TextBox txbNome;
        private TextBox txbDesc;
        private TextBox txbPreco;
        private PictureBox picImagem;
        private Label label1;
        private Label label2;
        private Label label3;
        private Label label4;
        private Label label5;
        private Label label6;
        private Label label7;
        private Button button1;
        private Button button2;
        private TextBox txtImg;
    }
}
