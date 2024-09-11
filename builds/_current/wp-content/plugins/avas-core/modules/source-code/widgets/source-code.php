<?php
namespace AvasElements\Modules\SourceCode\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SourceCode extends Widget_Base {

    public function get_name() {
        return 'avas-source-code';
    }

    public function get_title() {
        return esc_html__( 'Avas Source Code', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-editor-code';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'PrismJS', 'tx-source-code' ];
    }

    public function get_style_depends() {
        return [ 'PrismJS', 'tx-source-code'];
    }

    public function get_code_type() {
        return [
            'markup'            => esc_html__( 'HTML', 'avas-core' ),
            'css'               => esc_html__( 'CSS', 'avas-core' ),
            'php'               => esc_html__( 'PHP', 'avas-core' ),
            'javascript'        => esc_html__( 'JavaScript', 'avas-core' ),
            'actionscript'      => esc_html__( 'ActionScript', 'avas-core' ),
            'apacheconf'        => esc_html__( 'Apache Configuration', 'avas-core' ),
            'applescript'       => esc_html__( 'AppleScript', 'avas-core' ),
            'arduino'           => esc_html__( 'Arduino', 'avas-core' ),
            'aspnet'            => esc_html__( 'ASP.NET(C#)', 'avas-core' ),
            'bash'              => esc_html__( 'Bash', 'avas-core' ),
            'basic'             => esc_html__( 'BASIC', 'avas-core' ),
            'c'                 => esc_html__( 'C', 'avas-core' ),
            'csharp'            => esc_html__( 'C#', 'avas-core' ),
            'cpp'               => esc_html__( 'C++', 'avas-core' ),
            'clike'             => esc_html__( 'Clike', 'avas-core' ),
            'clojure'           => esc_html__( 'Clojure', 'avas-core' ),
            'coffeescript'      => esc_html__( 'CoffeeScript', 'avas-core' ),
            'dart'              => esc_html__( 'Dart', 'avas-core' ),
            'django'            => esc_html__( 'Django/Jinja2', 'avas-core' ),
            'docker'            => esc_html__( 'Docker', 'avas-core' ),
            'elixir'            => esc_html__( 'Elixir', 'avas-core' ),
            'erlang'            => esc_html__( 'Erlang', 'avas-core' ),
            'git'               => esc_html__( 'Git', 'avas-core' ),
            'go'                => esc_html__( 'Go', 'avas-core' ),
            'graphql'           => esc_html__( 'GraphQL', 'avas-core' ),
            'haml'              => esc_html__( 'Haml', 'avas-core' ),
            'haskell'           => esc_html__( 'Haskell', 'avas-core' ),
            'http'              => esc_html__( 'HTTP', 'avas-core' ),
            'hpkp'              => esc_html__( 'HTTP Public-Key-Pins', 'avas-core' ),
            'hsts'              => esc_html__( 'HTTP Strict-Transport-Security', 'avas-core' ),
            'java'              => esc_html__( 'Java', 'avas-core' ),
            'javadoc'           => esc_html__( 'JavaDoc', 'avas-core' ),
            'javadoclike'       => esc_html__( 'JavaDoc-like', 'avas-core' ),
            'javastacktrace'    => esc_html__( 'Java stack trace', 'avas-core' ),
            'jsdoc'             => esc_html__( 'JSDoc', 'avas-core' ),
            'js-extras'         => esc_html__( 'JS Extras', 'avas-core' ),
            'js-templates'      => esc_html__( 'JS Templates', 'avas-core' ),
            'json'              => esc_html__( 'JSON', 'avas-core' ),
            'jsonp'             => esc_html__( 'JSONP', 'avas-core' ),
            'json5'             => esc_html__( 'JSON5', 'avas-core' ),
            'kotlin'            => esc_html__( 'Kotlin', 'avas-core' ),
            'less'              => esc_html__( 'Less', 'avas-core' ),
            'lisp'              => esc_html__( 'Lisp', 'avas-core' ),
            'markdown'          => esc_html__( 'Markdown', 'avas-core' ),
            'markup-templating' => esc_html__( 'Markup templating', 'avas-core' ),
            'matlab'            => esc_html__( 'MATLAB', 'avas-core' ),
            'nginx'             => esc_html__( 'nginx', 'avas-core' ),
            'nix'               => esc_html__( 'Nix', 'avas-core' ),
            'objectivec'        => esc_html__( 'Objective-C', 'avas-core' ),
            'perl'              => esc_html__( 'Perl', 'avas-core' ),
            'phpdoc'            => esc_html__( 'PHPDoc', 'avas-core' ),
            'php-extras'        => esc_html__( 'PHP Extras', 'avas-core' ),
            'plsql'             => esc_html__( 'PL/SQL', 'avas-core' ),
            'powershell'        => esc_html__( 'PowerShell', 'avas-core' ),
            'python'            => esc_html__( 'Python', 'avas-core' ),
            'r'                 => esc_html__( 'R', 'avas-core' ),
            'jsx'               => esc_html__( 'React JSX', 'avas-core' ),
            'tsx'               => esc_html__( 'React TSX', 'avas-core' ),
            'regex'             => esc_html__( 'Regex', 'avas-core' ),
            'rest'              => esc_html__( 'reST (reStructuredText)', 'avas-core' ),
            'ruby'              => esc_html__( 'Ruby', 'avas-core' ),
            'sass'              => esc_html__( 'Sass (Sass)', 'avas-core' ),
            'scss'              => esc_html__( 'Sass (Scss)', 'avas-core' ),
            'scala'             => esc_html__( 'Scala', 'avas-core' ),
            'sql'               => esc_html__( 'SQL', 'avas-core' ),
            'stylus'            => esc_html__( 'Stylus', 'avas-core' ),
            'swift'             => esc_html__( 'Swift', 'avas-core' ),
            'twig'              => esc_html__( 'Twig', 'avas-core' ),
            'typescript'        => esc_html__( 'TypeScript', 'avas-core' ),
            'vbnet'             => esc_html__( 'VB.Net', 'avas-core' ),
            'visual-basic'      => esc_html__( 'Visual Basic', 'avas-core' ),
            'wasm'              => esc_html__( 'WebAssembly', 'avas-core' ),
            'wiki'              => esc_html__( 'Wiki markup', 'avas-core' ),
            'xquery'            => esc_html__( 'XQuery', 'avas-core' ),
            'yaml'              => esc_html__( 'YAML', 'avas-core' )
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'tx_sc_control_section',
            [
                'label' => esc_html__( 'Source Code', 'avas-core' )
            ]
        );

        $this->add_control(
            'tx_sc_code_type',
            [
                'label'   => esc_html__( 'Code', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'markup',
                'options' => $this->get_code_type()
            ]
        );

        $this->add_control(
            'tx_sc_code_theme',
            [
                'label'       => esc_html__('Theme', 'avas-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'prism',
                'options'     => [
                    'prism'                => esc_html__( 'Default', 'avas-core' ),
                    'prism-dark'           => esc_html__( 'Dark', 'avas-core' ),
                    'prism-funky'          => esc_html__( 'Funky', 'avas-core' ),
                    'prism-okaidia'        => esc_html__( 'Okaidia', 'avas-core' ),
                    'prism-twilight'       => esc_html__( 'Twilight', 'avas-core' ),
                    'prism-coy'            => esc_html__( 'Coy', 'avas-core' ),
                    'prism-solarizedlight' => esc_html__( 'Solarized light', 'avas-core' ),
                    'prism-tomorrow'       => esc_html__( 'Tomorrow', 'avas-core' ),
                    'custom'               => esc_html__( 'Custom', 'avas-core' )
                ]
            ]
        );

        $this->add_control(
            'tx_source_code',
            [
                'label'       => esc_html__( 'Source Code', 'avas-core' ),
                'type'        => Controls_Manager::CODE,
                'rows'        => 30,
                'default'     => __( '<!DOCTYPE html>
<html>
<body>

<h1>This is a heading.</h1>
<p>This is a paragraph.</p>

</body>
</html>
' ),
                'placeholder' => esc_html__( 'Paste your source code here.', 'avas-core' )
            ]
        );

        $this->add_control(
            'tx_sc_enable_line_number',
            [
                'label'        => esc_html__( 'Enable Line Number', 'avas-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_control(
            'tx_sc_enable_copy_button',
            [
                'label'        => esc_html__( 'Enable Copy Button', 'avas-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_control(
            'tx_sc_button_visibility_type',
            [
                'label'     => esc_html__( 'Button Visibility', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'always',
                'options'   => [
                    'always'   => esc_html__( 'Always',   'avas-core' ),
                    'on-hover' => esc_html__( 'On Hover', 'avas-core' )
                ],
                'condition' => [
                    'tx_sc_enable_copy_button' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_sc_button_position_type',
            [
                'label'     => esc_html__( 'Button Position', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'top-right',
                'options'   => [
                    'top-right'    => esc_html__( 'Top Right Corner',   'avas-core' ),
                    'bottom-right' => esc_html__( 'Bottom Right Corner', 'avas-core' )
                ],
                'condition' => [
                    'tx_sc_enable_copy_button' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_sc_copy_btn_text', [
                'label'     => esc_html__( 'Copy Button Text', 'avas-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Copy to clipboard', 'avas-core' ),
                'condition' => [
                    'tx_sc_enable_copy_button' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_sc_after_copied_btn_text', [
                'label'     => esc_html__( 'After Copied Button Text', 'avas-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Copied', 'avas-core' ),
                'condition' => [
                    'tx_sc_enable_copy_button' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_sc_container_style',
            [
                'label'     => esc_html__( 'Container', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'tx_sc_container_height',
            [
                'label'        => esc_html__( 'Height', 'avas-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => ['px', '%'],
                'range'        => [
                    'px'       => [
                        'min'  => 100,
                        'max'  => apply_filters( 'tx_sc_container_height_max_value', 1200 ),
                        'step' => 5
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .tx-source-code pre' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tx_sc_container_background_color',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => '#f5f2f0'
                    ]
                ],
                'selector' => '{{WRAPPER}} .custom :not(pre) > code[class*="language-"], {{WRAPPER}} .custom pre[class*="language-"]',
                'condition' => [
                    'tx_sc_code_theme' => 'custom'
                ]
            ]
        );

        $this->add_responsive_control(
            'tx_sc_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tx-source-code pre' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'tx_sc_container_margin',
            [
                'label'      => esc_html__( 'Margin', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tx-source-code pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_sc_container_typography',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .custom :not(pre) > code[class*="language-"], {{WRAPPER}} .custom pre[class*="language-"]  .language-markup',
                'condition' => [
                    'tx_sc_code_theme' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'tx_sc_container_text_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom :not(pre) > code[class*="language-"], {{WRAPPER}} .custom pre[class*="language-"]  .language-markup' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tx_sc_code_theme' => 'custom'
                ]
            ]
        );
        
        $this->add_control(
            'tx_sc_container_line_number_color',
            [
                'label' => esc_html__( 'Line Number Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-source-code .line-numbers-rows > span:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tx-source-code .line-numbers .line-numbers-rows' => 'border-right: 1px solid {{VALUE}};',
                ],
                'condition' => [
                    'tx_sc_code_theme' => 'custom'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'tx_sc_container_border',
                'selector' => '{{WRAPPER}} .tx-source-code pre'
            ]
        );

        $this->add_responsive_control(
            'tx_sc_container_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-source-code pre' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_sc_button_style',
            [
                'label'     => esc_html__( 'Button', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tx_sc_enable_copy_button' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'tx_sc_button_text_typography',
                'selector'         => '{{WRAPPER}} .tx-source-code pre .tx-sc-copy-button'
            ]
        );

        $this->add_control(
            'tx_sc_button_color',
            [
                'label'     => esc_html__( 'Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-source-code pre .tx-sc-copy-button' => 'color: {{VALUE}};'
                ]   
            ]
        );

        $this->add_control(
            'tx_sc_button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-source-code pre .tx-sc-copy-button' => 'background-color: {{VALUE}};'
                ]   
            ]
        );

        $this->add_responsive_control(
            'tx_sc_button_padding',
            [
                'label'        => esc_html__( 'Padding', 'avas-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'selectors'    => [
                    '{{WRAPPER}} .tx-source-code pre .tx-sc-copy-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'tx_sc_button_border',
                'selector' => '{{WRAPPER}} .tx-source-code pre .tx-sc-copy-button'
            ]
        );

        $this->add_responsive_control(
            'tx_sc_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-source-code pre .tx-sc-copy-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings         = $this->get_settings_for_display();
        $tx_source_code = $settings['tx_source_code'];
        $line_number = 'disable-line-numbers';

        if( 'yes' === $settings['tx_sc_enable_line_number'] ) :
            $line_number = 'line-numbers';
        endif;

        $this->add_render_attribute( 'tx_source_code_wrapper', 'class', 'tx-source-code' );
        $this->add_render_attribute( 'tx_source_code_wrapper', 'class', esc_attr( $settings['tx_sc_code_theme'] ) );
        $this->add_render_attribute( 'tx_source_code_wrapper', 'data-lng-type', esc_attr( $settings['tx_sc_code_type'] ) );

        if( 'yes' === $settings['tx_sc_enable_copy_button'] && ! empty( $settings['tx_sc_after_copied_btn_text'] ) ) :
            $this->add_render_attribute( 'tx_source_code_wrapper', 'data-after-copied-btn-text', esc_attr( $settings['tx_sc_after_copied_btn_text'] ) );
            $this->add_render_attribute( 'tx_source_code_wrapper', 'class', 'visibility-'.esc_attr( $settings['tx_sc_button_visibility_type'] ) );
            $this->add_render_attribute( 'tx_source_code_wrapper', 'class', 'position-'.esc_attr( $settings['tx_sc_button_position_type'] ) );
        endif;

        $this->add_render_attribute( 'tx_source_code', 'class', 'language-' . $settings['tx_sc_code_type'] );

        if ( $tx_source_code ) : ?>
            <div <?php $this->print_render_attribute_string('tx_source_code_wrapper'); ?>>
                <pre class="<?php echo esc_attr( $line_number ); ?>">
                    <?php
                    if( 'yes' === $settings['tx_sc_enable_copy_button'] && ! empty( $settings['tx_sc_after_copied_btn_text'] ) ) : ?>
                        <button class="tx-sc-copy-button"><?php echo esc_html( $settings['tx_sc_copy_btn_text'] ); ?></button>
                    <?php endif; ?>
                    <code <?php $this->print_render_attribute_string('tx_source_code'); ?>>
                        <?php echo esc_html( $tx_source_code ); ?>
                    </code>
                </pre>
            </div>
        <?php    
        endif;
    }
}

