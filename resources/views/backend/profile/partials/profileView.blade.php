<div class="col-xl-6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card profile-card">
                <div class="card-body pb-0 position-relative">
                    <div class="profile-banner-img">
                        <img src="{{ asset('backend/assets/images/media/media-74.jpg') }}" class="rounded w-100"
                            alt="Banner">
                    </div>
                    <span class="avatar avatar-xxl avatar-rounded bg-light">
                        <img src="{{ asset('storage/' . ($user->profile_img_upload ?? 'backend/assets/images/faces/2.jpg')) }}"
                            alt="User Image">
                    </span>
                    <div class="mt-4 mb-0 p-4 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                        <div>
                            <h5 class="fw-semibold mb-3">{{ $user->name }}</h5>
                            <span class="d-block fw-medium text-muted mb-1">
                                {{ $user->employeeExtDetail->role ?? 'User' }}
                            </span>
                            <p class="fs-12 mb-0 fw-medium text-muted">
                                <span class="me-3"><i class="ri-map-pin-line me-1 align-middle"></i>
                                    {{ $user->employeeExtDetail->address ?? 'Not Available' }}</span>
                            </p>
                        </div>
                        <div class="d-flex mb-0 flex-wrap gap-4">
                            <div class="py-2 ps-2 pe-3 rounded-pill d-flex align-items-center border gap-3">
                                <div class="main-card-icon primary">
                                    <div
                                        class="avatar avatar-md avatar-rounded bg-primary-transparent svg-primary border border-primary border-opacity-25">
                                        <i class="ri-folder-line ri-xl"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="fw-semibold h6 mb-0">{{ $user->employeeExtDetail->projects ?? 0 }}</p>
                                    <p class="mb-0 fs-12 text-muted fw-medium">Projects</p>
                                </div>
                            </div>
                            <div class="py-2 ps-2 pe-3 rounded-pill d-flex align-items-center border gap-3">
                                <div class="main-card-icon secondary">
                                    <div
                                        class="avatar avatar-rounded avatar-md bg-secondary-transparent svg-secondary border border-secondary border-opacity-25">
                                        <i class="ri-bar-chart-2-line ri-xl"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="fw-semibold h6 mb-0">
                                        {{ $user->employeeExtDetail->experience ?? '0 Years' }}
                                    </p>
                                    <p class="mb-0 fs-12 text-muted fw-medium">Experience</p>
                                </div>
                            </div>
                            <div class="py-2 ps-2 pe-3 rounded-pill d-flex align-items-center border gap-2">
                                <div class="main-card-icon success">
                                    <div
                                        class="avatar avatar-rounded avatar-md bg-success-transparent svg-success border border-success border-opacity-25">
                                        <i class="ri-money-dollar-circle-line ri-xl"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="fw-semibold h6 mb-0">${{ $user->employeeExtDetail->earnings ?? '0.00' }}
                                    </p>
                                    <p class="mb-0 fs-12 text-muted fw-medium">Earning</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3 border-top">
                            <span class="fw-medium fs-15 d-block mb-3">Currently In Team and Role</span>
                            <p class="text-muted mb-2">
                                {{ $user->employeeExtDetail->team ?? 'No biography available.' }},
                                {{ $user->employeeExtDetail->role ?? 'No biography available.' }}
                            </p>
                        </li>
                        <li class="list-group-item p-3 border-top">
                            <span class="fw-medium fs-15 d-block mb-3">Personal Bio :</span>
                            <p class="text-muted mb-2">
                                {!! $user->employeeExtDetail->bio ?? 'No biography available.' !!}
                            </p>
                        </li>
                        <li class="list-group-item p-3">
                            <span class="fw-medium fs-15 d-block mb-3">Skills :</span>
                            <div class="w-75">
                                @foreach(explode(',', $user->employeeExtDetail->skills ?? '') as $skill)
                                @if(!empty($skill))
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light text-muted m-1 border">{{ trim($skill) }}</span>
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>