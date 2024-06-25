<?php

class email_class {

	var $nadawca, $wiadomosc, $temat, $naglowek;

	public function assign_vars($vars) {
		$this->vars = (empty($this->vars)) ? $vars : $this->vars + $vars;
	}

	private function wyslijWiadomosc() {

		global $classMain;

		if (is_array($this->adresat)) {
			for ($i = 0; $i < count($this->adresat); $i++) {
				$classMain->sendEmailNow($this->temat, $this->wiadomosc, $this->adresat[$i], $this->nadawca, $this->nadawca_nazwa, $this->adresZalacznika, $this->nazwaZalacznika);
			}
		} else {
			$classMain->sendEmailNow($this->temat, $this->wiadomosc, $this->adresat, $this->nadawca, $this->nadawca_nazwa, $this->adresZalacznika, $this->nazwaZalacznika);
		}
	}


	public function email_sender($adresat, $plik, $temat, $nadawca=false, $nadawca_nazwa=false, $adresZalacznika=false, $nazwaZalacznika=false) {
		$this->adresat = $adresat;
		$this->temat = $temat;
		$this->nadawca = $nadawca;
		$this->nadawca_nazwa = $nadawca_nazwa;
		$this->adresZalacznika = $adresZalacznika;
		$this->nazwaZalacznika = $nazwaZalacznika;
		$this->tworzenieNaglowka();
		$this->tworzenieWaidmosci($plik);
		$this->wyslijWiadomosc();
	}

	private function tworzenieNaglowka() {

		global $mainConfig;

		if (!isset($this->nadawca) || empty($this->nadawca)) $this->nadawca = $mainConfig['poczta_email'];

		$content = array();
		$content[] = 'From: ' . $this->nadawca;
		$content[] = 'Reply-To: ' . $this->nadawca;
		$content[] = 'Return-Path: <' . $this->nadawca . '>';
		$content[] = 'Sender: <' . $mainConfig['poczta_email'] . '>';
		$content[] = 'MIME-Version: 1.0';
		$content[] = 'Date: ' . gmdate('r', time());
		$content[] = 'Content-Type: text/html; charset=utf8';
		$content[] = 'Content-Transfer-Encoding: 8bit';

		$this->naglowek = implode("\n", $content);
	}

	private function tworzenieWaidmosci($plik) {

		$buffer = file(dirname(__FILE__).'/../../theme/emails/' . $plik);
		$i = 0;
		$j = 0;
		while ($i < count($buffer)) {
			if (!@preg_match("^#(.)*$", $buffer[$i])) {
				$skipped_buffer[$j] = $buffer[$i];
				$j++;
			}
			$i++;
		}
		$this->wiadomosc = implode('', $skipped_buffer);
		$this->wiadomosc = str_replace("'", "\'", $this->wiadomosc);

		$this->wiadomosc = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . ((isset(\$this->vars['\\1'])) ? \$this->vars['\\1'] : '') . '", $this->wiadomosc);

		preg_match_all('#<!-- ([^<].*?) (.*?)? ?-->#', $this->wiadomosc, $blocks, PREG_SET_ORDER);

		$text_blocks = preg_split('#<!-- [^<].*? (?:.*?)? ?-->#', $this->wiadomosc);

		$compile_blocks = array();
		for ($curr_tb = 0, $tb_size = sizeof($blocks); $curr_tb < $tb_size; $curr_tb++) {
			$block_val = &$blocks[$curr_tb];

			switch ($block_val[1]) {
				case 'IF':
					$compile_blocks[] = "'; " . $this->compile_tag_if (str_replace("\'", "'", $block_val[2]), false) . " \$this->wiadomosc .= '";
				break;

				case 'ELSE':
					$compile_blocks[] = "'; } else { \$this->wiadomosc .= '";
				break;

				case 'ELSEIF':
					$compile_blocks[] = "'; " . $this->compile_tag_if (str_replace("\'", "'", $block_val[2]), true) . " \$this->wiadomosc .= '";
				break;

				case 'ENDIF':
					$compile_blocks[] = "'; } \$this->wiadomosc .= '";
				break;
			}
		}

		$template_php = '';
		for ($i = 0, $size = sizeof($text_blocks); $i < $size; $i++) {
			$trim_check_text = trim($text_blocks[$i]);
			$template_php .= (($trim_check_text != '') ? $text_blocks[$i] : '') . ((isset($compile_blocks[$i])) ? $compile_blocks[$i] : '');
		}

		eval("\$this->wiadomosc = '$template_php';");
	}

	private function compile_tag_if ($tag_args, $elseif) {

		preg_match_all('/(?:
			"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"		 |
			\'[^\'\\\\]*(?:\\\\.[^\'\\\\]*)*\'	 |
			[(),]								  |
			[^\s(),]+)/x', $tag_args, $match);

		$symbols = $match[0];
		$is_arg_stack = array();

		for ($i = 0, $size = sizeof($symbols); $i < $size; $i++) {
			$symbol = &$symbols[$i];

			switch ($symbol) {
				case '!==':
				case '===':
				case '<<':
				case '>>':
				case '|':
				case '^':
				case '&':
				case '~':
				case ')':
				case ',':
				case '+':
				case '-':
				case '*':
				case '/':
				case '@':
				break;

				case '==':
					$symbol = '==';
				break;

				case '!=':
					$symbol = '!=';
				break;

				case '<':
					$symbol = '<';
				break;

				case '<=':
					$symbol = '<=';
				break;

				case '>':
					$symbol = '>';
				break;

				case '>=':
					$symbol = '>=';
				break;

				case '&&':
					$symbol = '&&';
				break;

				case '||':
					$symbol = '||';
				break;

				case '!':
					$symbol = '!';
				break;

				case '%':
					$symbol = '%';
				break;

				case '(':
					array_push($is_arg_stack, $i);
				break;

				case 'is':
					$is_arg_start = ($symbols[$i-1] == ')') ? array_pop($is_arg_stack) : $i-1;
					$is_arg	= implode('	', array_slice($symbols,	$is_arg_start, $i -	$is_arg_start));

					$new_symbols	= $this->_parse_is_expr($is_arg, array_slice($symbols, $i+1));

					array_splice($symbols, $is_arg_start, sizeof($symbols), $new_symbols);

					$i = $is_arg_start;

				default:
					if (preg_match('#^((?:[a-z0-9\-_]+\.)+)?(\$)?(?=[A-Z])([A-Z0-9\-_]+)#s', $symbol, $varrefs)) {
						$symbol = (!empty($varrefs[1])) ? $this->generate_block_data_ref(substr($varrefs[1], 0, -1), true, $varrefs[2]) . '[\'' . $varrefs[3] . '\']' : (($varrefs[2]) ? '$this->vars[\'DEFINE\'][\'.\'][\'' . $varrefs[3] . '\']' : '$this->vars[\'' . $varrefs[3] . '\']');
					} elseif (preg_match('#^\.((?:[a-z0-9\-_]+\.?)+)$#s', $symbol, $varrefs)) {

						$blocks = explode('.', $varrefs[1]);

						if (sizeof($blocks) > 1) {
							$block = array_pop($blocks);
							$namespace = implode('.', $blocks);
							$varref = $this->generate_block_data_ref($namespace, true);

							$varref .= "['" . $block . "']";
						} else {
							$varref = '$this->_tpldata';

							$varref .= "['" . $blocks[0] . "']";
						}
						$symbol = "sizeof($varref)";
					} elseif (!empty($symbol)) {
						$symbol = '(' . $symbol . ')';
					}

				break;
			}
		}

		if (!sizeof($symbols) || str_replace(array(' ', '=', '!', '<', '>', '&', '|', '%', '(', ')'), '', implode('', $symbols)) == '') $symbols = array('false');
		return (($elseif) ? '} else if (' : 'if (') . (implode(' ', $symbols) . ') { ');
	}

	private function generate_block_data_ref($blockname, $include_last_iterator, $defop = false) {

		$blocks = explode('.', $blockname);
		$blockcount = sizeof($blocks) - 1;

		if ($defop) {
			$varref = '$this->_tpldata[\'DEFINE\']';

			for ($i = 0; $i < $blockcount; $i++) {
				$varref .= "['" . $blocks[$i] . "'][\$_" . $blocks[$i] . '_i]';
			}

			$varref .= "['" . $blocks[$blockcount] . "']";

			if ($include_last_iterator) {
				$varref .= '[$_' . $blocks[$blockcount] . '_i]';
			}
			return $varref;
		} else if ($include_last_iterator) {
			return '$_'. $blocks[$blockcount] . '_val';
		} else {
			return '$_'. $blocks[$blockcount - 1] . '_val[\''. $blocks[$blockcount]. '\']';
		}
	}
}
?>
