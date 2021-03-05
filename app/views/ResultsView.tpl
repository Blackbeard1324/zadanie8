{extends file="main.tpl"}

{block name=content}
    <!-- Tabela -->
    <section>
        <h2>Wynik</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>ID wyniku</th>
                    <th>Kwota</th>
                    <th>Lata</th>
                    <th>Procent</th>
                    <th>Rata</th>
                    <th>Data wykonania obliczeń</th>
                </tr>
                </thead>
                <tbody>
                {$i = 1}
                {foreach $results as $dane}
                    <tr>
                        <td>{$i++} </td>
                        <td>{$dane["kwota"]|string_format:"%.2f"}</td>
                        <td>{$dane["lata"]}</td>
                        <td>{$dane["procent"]|string_format:"%.2f"}%</td>
                        <td>{$dane["result"]|string_format:"%.2f"} PLN</td>
                        <td>{$dane["data"]}</td>
                    </tr>
                {/foreach}

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </section>

{/block}