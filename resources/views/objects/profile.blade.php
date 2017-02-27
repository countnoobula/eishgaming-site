                        <div>
                            <table class="egn-table">
                                <tbody>
                                    <tr>
                                        <td>Online Persona</td>
                                        <td>{{ $profile->getDisplayName() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{ $profile->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{ $profile->getStatusLabel() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Age</td>
@if ($profile->getBirthday()->diffInYears() > 0)
                                        <td>{{ $profile->getBirthday()->diffInYears() }} Years old</td>
@else
                                        <td class="egn-highlight">(not set)</td>
@endif
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $profile->getEmail() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>{{ $profile->getPhoneNumber() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
