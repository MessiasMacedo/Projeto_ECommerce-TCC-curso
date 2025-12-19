namespace WinFormsApp3
{
    partial class Menu
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            panelMenu = new Panel();
            panel1 = new Panel();
            btnSair = new Button();
            btnUsuários = new Button();
            btnEstoque = new Button();
            btnProdutos = new Button();
            button2 = new Button();
            button1 = new Button();
            panelConteudo = new Panel();
            btnCadEditProd = new Button();
            panelMenu.SuspendLayout();
            panel1.SuspendLayout();
            SuspendLayout();
            // 
            // panelMenu
            // 
            panelMenu.Controls.Add(panel1);
            panelMenu.Controls.Add(button2);
            panelMenu.Controls.Add(button1);
            panelMenu.Dock = DockStyle.Left;
            panelMenu.Location = new Point(0, 0);
            panelMenu.Name = "panelMenu";
            panelMenu.Size = new Size(200, 486);
            panelMenu.TabIndex = 0;
            // 
            // panel1
            // 
            panel1.Controls.Add(btnSair);
            panel1.Controls.Add(btnUsuários);
            panel1.Controls.Add(btnEstoque);
            panel1.Controls.Add(btnCadEditProd);
            panel1.Controls.Add(btnProdutos);
            panel1.Dock = DockStyle.Left;
            panel1.Location = new Point(0, 0);
            panel1.Name = "panel1";
            panel1.Size = new Size(200, 486);
            panel1.TabIndex = 3;
            // 
            // btnSair
            // 
            btnSair.Dock = DockStyle.Bottom;
            btnSair.FlatStyle = FlatStyle.Flat;
            btnSair.ForeColor = Color.Black;
            btnSair.Location = new Point(0, 447);
            btnSair.Name = "btnSair";
            btnSair.Size = new Size(200, 39);
            btnSair.TabIndex = 4;
            btnSair.Text = "Sair";
            btnSair.TextAlign = ContentAlignment.MiddleLeft;
            btnSair.UseVisualStyleBackColor = true;
            btnSair.Click += btnSair_Click;
            // 
            // btnUsuários
            // 
            btnUsuários.Dock = DockStyle.Top;
            btnUsuários.FlatStyle = FlatStyle.Flat;
            btnUsuários.ForeColor = Color.Black;
            btnUsuários.Location = new Point(0, 117);
            btnUsuários.Name = "btnUsuários";
            btnUsuários.Size = new Size(200, 39);
            btnUsuários.TabIndex = 3;
            btnUsuários.Text = "Usuários";
            btnUsuários.TextAlign = ContentAlignment.MiddleLeft;
            btnUsuários.UseVisualStyleBackColor = true;
            // 
            // btnEstoque
            // 
            btnEstoque.Dock = DockStyle.Top;
            btnEstoque.FlatStyle = FlatStyle.Flat;
            btnEstoque.ForeColor = Color.Black;
            btnEstoque.Location = new Point(0, 78);
            btnEstoque.Name = "btnEstoque";
            btnEstoque.Size = new Size(200, 39);
            btnEstoque.TabIndex = 2;
            btnEstoque.Text = "Estoque";
            btnEstoque.TextAlign = ContentAlignment.MiddleLeft;
            btnEstoque.UseVisualStyleBackColor = true;
            btnEstoque.Click += btnEstoque_Click;
            // 
            // btnProdutos
            // 
            btnProdutos.Dock = DockStyle.Top;
            btnProdutos.FlatStyle = FlatStyle.Flat;
            btnProdutos.ForeColor = Color.Black;
            btnProdutos.Location = new Point(0, 0);
            btnProdutos.Name = "btnProdutos";
            btnProdutos.Size = new Size(200, 39);
            btnProdutos.TabIndex = 1;
            btnProdutos.Text = "Ver Produtos";
            btnProdutos.TextAlign = ContentAlignment.MiddleLeft;
            btnProdutos.UseVisualStyleBackColor = true;
            btnProdutos.Click += btnProdutos_Click;
            // 
            // button2
            // 
            button2.Location = new Point(12, 89);
            button2.Name = "button2";
            button2.Size = new Size(169, 39);
            button2.TabIndex = 2;
            button2.Text = "button2";
            button2.UseVisualStyleBackColor = true;
            // 
            // button1
            // 
            button1.Location = new Point(12, 25);
            button1.Name = "button1";
            button1.Size = new Size(169, 39);
            button1.TabIndex = 1;
            button1.Text = "button1";
            button1.UseVisualStyleBackColor = true;
            // 
            // panelConteudo
            // 
            panelConteudo.Dock = DockStyle.Fill;
            panelConteudo.Location = new Point(200, 0);
            panelConteudo.Name = "panelConteudo";
            panelConteudo.Size = new Size(696, 486);
            panelConteudo.TabIndex = 1;
            // 
            // btnCadEditProd
            // 
            btnCadEditProd.Dock = DockStyle.Top;
            btnCadEditProd.FlatStyle = FlatStyle.Flat;
            btnCadEditProd.ForeColor = Color.Black;
            btnCadEditProd.Location = new Point(0, 39);
            btnCadEditProd.Name = "btnCadEditProd";
            btnCadEditProd.Size = new Size(200, 39);
            btnCadEditProd.TabIndex = 0;
            btnCadEditProd.Text = "Cadastrar / Editar Produtos";
            btnCadEditProd.TextAlign = ContentAlignment.MiddleLeft;
            btnCadEditProd.UseVisualStyleBackColor = true;
            btnCadEditProd.Click += btnCadEditProd_Click;
            // 
            // Menu
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(896, 486);
            Controls.Add(panelConteudo);
            Controls.Add(panelMenu);
            ForeColor = Color.Coral;
            Name = "Menu";
            Text = "Menu";
            panelMenu.ResumeLayout(false);
            panel1.ResumeLayout(false);
            ResumeLayout(false);
        }

        #endregion

        private Panel panelMenu;
        private Panel panel1;
        private Button btnSair;
        private Button btnUsuários;
        private Button btnEstoque;
        private Button btnProdutos;
        private Button button2;
        private Button button1;

        private void FrmMenu_Load(object sender, EventArgs e)
        {
            foreach (Control c in panelMenu.Controls)
            {
                if (c is Button btn)
                {
                    btn.FlatStyle = FlatStyle.Flat;
                    btn.FlatAppearance.BorderSize = 0;
                    btn.ForeColor = Color.White;
                    btn.BackColor = Color.FromArgb(44, 47, 51);

                    btn.MouseEnter += (s, ev) =>
                    {
                        btn.BackColor = Color.FromArgb(64, 68, 75); // hover
                    };

                    btn.MouseLeave += (s, ev) =>
                    {
                        btn.BackColor = Color.FromArgb(44, 47, 51);
                    };
                }
            }
        }
        private Panel panelConteudo;
        private Button btnCadEditProd;
    }
}