namespace WinFormsApp3
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
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
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            lblUsuario = new Label();
            lblSenha = new Label();
            txbUsuario = new TextBox();
            txbSenha = new TextBox();
            btnEntrar = new Button();
            chbExibir = new CheckBox();
            lblinkEsqueci = new LinkLabel();
            pictureBox1 = new PictureBox();
            pictureBox2 = new PictureBox();
            label2 = new Label();
            btnCadastar = new Button();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox2).BeginInit();
            SuspendLayout();
            // 
            // lblUsuario
            // 
            lblUsuario.AutoSize = true;
            lblUsuario.Location = new Point(93, 35);
            lblUsuario.Name = "lblUsuario";
            lblUsuario.Size = new Size(59, 20);
            lblUsuario.TabIndex = 0;
            lblUsuario.Text = "Usuário";
            // 
            // lblSenha
            // 
            lblSenha.AutoSize = true;
            lblSenha.Location = new Point(93, 121);
            lblSenha.Name = "lblSenha";
            lblSenha.Size = new Size(49, 20);
            lblSenha.TabIndex = 1;
            lblSenha.Text = "Senha";
            // 
            // txbUsuario
            // 
            txbUsuario.Location = new Point(93, 58);
            txbUsuario.Name = "txbUsuario";
            txbUsuario.Size = new Size(141, 27);
            txbUsuario.TabIndex = 2;
            // 
            // txbSenha
            // 
            txbSenha.BackColor = SystemColors.HighlightText;
            txbSenha.Location = new Point(93, 144);
            txbSenha.Name = "txbSenha";
            txbSenha.Size = new Size(141, 27);
            txbSenha.TabIndex = 3;
            txbSenha.UseSystemPasswordChar = true;
            // 
            // btnEntrar
            // 
            btnEntrar.BackColor = Color.White;
            btnEntrar.BackgroundImageLayout = ImageLayout.Center;
            btnEntrar.Location = new Point(58, 213);
            btnEntrar.Name = "btnEntrar";
            btnEntrar.Size = new Size(94, 29);
            btnEntrar.TabIndex = 4;
            btnEntrar.Text = "Entrar";
            btnEntrar.UseVisualStyleBackColor = false;
            btnEntrar.Click += btnEntrar_Click;
            // 
            // chbExibir
            // 
            chbExibir.AutoSize = true;
            chbExibir.Location = new Point(37, 183);
            chbExibir.Name = "chbExibir";
            chbExibir.Size = new Size(68, 24);
            chbExibir.TabIndex = 5;
            chbExibir.Text = "Exibir";
            chbExibir.UseVisualStyleBackColor = true;
            chbExibir.CheckedChanged += chbExibir_CheckedChanged;
            // 
            // lblinkEsqueci
            // 
            lblinkEsqueci.AutoSize = true;
            lblinkEsqueci.Location = new Point(189, 184);
            lblinkEsqueci.Name = "lblinkEsqueci";
            lblinkEsqueci.Size = new Size(113, 20);
            lblinkEsqueci.TabIndex = 6;
            lblinkEsqueci.TabStop = true;
            lblinkEsqueci.Text = "Esqueci a senha";
            // 
            // pictureBox1
            // 
            pictureBox1.BackColor = Color.Transparent;
            pictureBox1.BackgroundImage = Properties.Resources.icons8_account_male_96;
            pictureBox1.BackgroundImageLayout = ImageLayout.Stretch;
            pictureBox1.Location = new Point(37, 58);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(45, 38);
            pictureBox1.TabIndex = 7;
            pictureBox1.TabStop = false;
            // 
            // pictureBox2
            // 
            pictureBox2.BackColor = Color.Transparent;
            pictureBox2.BackgroundImage = Properties.Resources.icons8_password_50;
            pictureBox2.BackgroundImageLayout = ImageLayout.Stretch;
            pictureBox2.Location = new Point(37, 135);
            pictureBox2.Name = "pictureBox2";
            pictureBox2.Size = new Size(45, 36);
            pictureBox2.TabIndex = 8;
            pictureBox2.TabStop = false;
            pictureBox2.UseWaitCursor = true;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Location = new Point(55, 285);
            label2.Name = "label2";
            label2.Size = new Size(0, 20);
            label2.TabIndex = 10;
            // 
            // btnCadastar
            // 
            btnCadastar.Location = new Point(177, 213);
            btnCadastar.Name = "btnCadastar";
            btnCadastar.Size = new Size(94, 29);
            btnCadastar.TabIndex = 11;
            btnCadastar.Text = "Cadastrar";
            btnCadastar.UseVisualStyleBackColor = true;
            btnCadastar.Click += btnCadastar_Click;
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = SystemColors.ActiveCaption;
            BackgroundImageLayout = ImageLayout.None;
            ClientSize = new Size(352, 335);
            Controls.Add(btnCadastar);
            Controls.Add(label2);
            Controls.Add(pictureBox2);
            Controls.Add(pictureBox1);
            Controls.Add(lblinkEsqueci);
            Controls.Add(chbExibir);
            Controls.Add(btnEntrar);
            Controls.Add(txbSenha);
            Controls.Add(txbUsuario);
            Controls.Add(lblSenha);
            Controls.Add(lblUsuario);
            DoubleBuffered = true;
            Name = "Form1";
            Text = "Form1";
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox2).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label lblUsuario;
        private Label lblSenha;
        private TextBox txbUsuario;
        private TextBox txbSenha;
        private Button btnEntrar;
        private CheckBox chbExibir;
        private LinkLabel lblinkEsqueci;
        private PictureBox pictureBox1;
        private PictureBox pictureBox2;
        private Label label2;
        private Button btnCadastar;
    }


}


